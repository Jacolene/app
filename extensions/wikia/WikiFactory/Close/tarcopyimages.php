<?php

/**
 * @package MediaWiki
 * @addtopackage maintenance
 */

ini_set( "include_path", dirname(__FILE__)."/../../../../maintenance/" );
require_once( "commandLine.inc" );
require_once( "Archive/Tar.php" );

class CloseWikiTarAndCopyImages {

	private $mTarget;

	/**
	 * constructor
	 *
	 * @access public
	 */
	public function __construct() {
		global $wgDevelEnvironment;
		if( !empty( $wgDevelEnvironment ) ) {
			$this->mTarget = "root@127.0.0.1:/tmp/dumps";
		}
		else {
			$this->mTarget = "root@10.6.10.39:/backup/dumps";
		}
	}

	/**
	 * 1. go through all wikis which are marked for closing and check which one
	 * 	want to have images packed.
	 *
	 * 2. pack images, send them via rsync to  target server,
	 *
	 * 3. mark in city_list.city_flags that images are sent,
	 *
	 * 4. remove images
	 *
	 * @access public
	 */
	public function execute() {
		global $wgUploadDirectory, $wgDBname;

		$dbr = WikiFactory::db( DB_SLAVE );
		$sth = $dbr->select(
			array( "city_list" ),
			array( "city_id", "city_flags", "city_dbname" ),
			array( "city_public" => array( 0, -1 ) ),
			__METHOD__
		);
		while( $row = $dbr->fetchObject( $sth ) ) {
			if( $row->city_flags & WikiFactory::FLAG_CREATE_IMAGE_ARCHIVE ) {
				$dbname = $row->city_dbname;
				$folder = WikiFactory::getVarValueByName( "wgUploadDirectory", $row->city_id );
				if( $dbname && $folder ) {
					$source = $this->tarFiles( $folder, $dbname );
					$target = DumpsOnDemand::getUrl( $dbname, "images.tar", $this->mTarget );
					if( $source && $target ) {
						$cmd = wfEscapeShellArg(
							"/usr/bin/rsync",
							"-axpr",
							"--quiet",
							"--owner",
							"--group",
							"--chmod=g+w",
							$source,
							escapeshellcmd( $target )
						);
						print $cmd  . "\n";
						unlink( $source );
					}
				}
			}
		}
	}

	/**
	 * pack all images from image table, use PEAR Archive_Tar for archive.
	 *
	 * @access public
	 *
	 * @param string $uploadDirectory path to images
	 * @param string $dbname database name
	 *
	 * @return string path to created archive or false if not created
	 */
	public function tarFiles( $directory, $dbname ) {

		/**
		 * @name dumpfile
		 */
		$tarfile = sprintf( "/tmp/{$dbname}-images.tar" );
		if( file_exists( $tarfile ) ) {
			@unlink( $tarfile );
		}

		$tar = new Archive_Tar( $tarfile );

		if( ! $tar ) {
			Wikia::log( __CLASS__, "tar", "Cannot open {$tarfile}" );
			wfDie( "Cannot open {$tarfile}" );
		}
		$files = $this->getDirTree( $directory );

		if( is_array( $files ) && count( $files ) ) {
			Wikia::log( __CLASS__, "info", sprintf( "Packing %d images from {$directory} to {$tarfile}", count( $files ) ) );
			$tar->create( $files );
			$result = $tarfile;
		}
		else {
			Wikia::log( __CLASS__, "info", "List of images in {$directory} is empty" );
			$result = false;
		}
		return $result;
	}

	/**
	 * Get images list from folder, recursive, skip thumbnails directory
	 *
	 * @return array
	 */
	private function getDirTree( $dir ) {

		$files = array();

		wfProfileIn( __METHOD__ );

		if( is_dir( $dir ) ) {
			$dirs = array_diff( scandir( $dir ), array( ".", ".." ) );
		    foreach( $dirs as $d ) {
				$path = $dir . "/" . $d;
				if( is_dir( $path ) ) {
					$files = array_merge( $files, $this->getDirTree( $path, $files ) );
				}
				else {
					if( strpos( $path, "/images/thumb/") === false ) {
						$files[] = $path;
					}
				}
			}
		}
		wfProfileOut( __METHOD__ );

		return $files;
	}

}

$wgAutoloadClasses[ "DumpsOnDemand" ] = "$IP/extensions/wikia/WikiFactory/Dumps/DumpsOnDemand.php";
$maintenance = new CloseWikiTarAndCopyImages;
$maintenance->execute();
