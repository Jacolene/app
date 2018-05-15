<?php

use Wikia\Logger\Loggable;
use Wikia\Tasks\Tasks\BaseTask;

/**
 * Class RemoveUserDataOnWikiTask
 *
 * Removes or anonimizes all PII for a specific user on the current community
 *
 */
class RemoveUserDataOnWikiTask extends BaseTask {
	use Loggable;
	
	const USER_NAMESPACES = [
		2, // NS_USER,
		3, // NS_USER_TALK
		500, // NS_BLOG_ARTICLE
		1200, // NS_USER_WALL
		1201, // NS_USER_WALL_MESSAGE
		1202 // NS_USER_WALL_GREETING
	];

	/**
	 * Deletes all CheckUser records associated with the given user
	 *
	 * @param int $userId
	 * @throws DBUnexpectedError
	 * @return true if operation was successful
	 */
	private function removeCheckUserData( int $userId ) {
		try {
			$db = wfGetDB( DB_MASTER );
			// remove check user data
			$db->delete( 'cu_changes', ['cuc_user' => $userId], __METHOD__ );
			$db->delete( 'cu_log', ['cul_target_id' => $userId], __METHOD__ );
			$this->info( "Removed CheckUser data", ['user_id' => $userId] );
			return true;
		} catch( DBError $error ) {
			$this->error( "Couldn't remove CheckUser data", ['exception' => $error, 'user_id' => $userId] );
			return false;
		}
	}

	/**
	 * Removes the IP address from all RecentChanges records associated with the given user
	 *
	 * @param int $userId
	 * @return true if operation was successful
	 */
	private function removeIpFromRecentChanges( int $userId ) {
		try {
			$db = wfGetDB( DB_MASTER );
			$db->update( 'recentchanges', ['rc_ip_bin' => ''], ['rc_user' => $userId], __METHOD__ );
			$this->info( "Removed IPs from recent changes", ['user_id' => $userId] );
			return true;
		} catch( DBError $error ) {
			$this->error( "Couldn't remove IP from recent changes", ['exception' => $error, 'user_id' => $userId] );
			return false;
		}
	}

	/**
	 * Removes abuse filter logs associated with the given user
	 *
	 * @param int $userId
	 * @return true if operation was successful
	 */
	private function removeAbuseFilterData( int $userId ) {
		global $wgEnableAbuseFilterExtension;
		if( $wgEnableAbuseFilterExtension ) {
			try {
				$db = wfGetDB( DB_MASTER );
				$db->update( 'abuse_filter', ['af_user_text' => ''], ['af_user' => $userId], __METHOD__ );
				$db->update( 'abuse_filter_history', ['afh_user_text' => ''], ['afh_user' => $userId], __METHOD__ );
				$db->delete( 'abuse_filter_log', ['afl_user' => $userId], __METHOD__ );
				$this->info( "Removed abuse filter data", ['user_id' => $userId] );
				return true;
			} catch ( DBError $error) {
				$this->error( "Couldn't remove abuse filter data", ['exception' => $error, 'user_id' => $userId] );
				return false;
			}
		}
		return true;
	}

	/**
	 * Permanently removes the userpage and user's talk, blog and wall pages.
	 *
	 * Since this method relies on the username, it may be impossible to retry this operation
	 * after the user's global data is removed.
	 *
	 * @param string $username
	 * @return true if operation was successful
	 */
	private function removeUserPages( string $username ) {
		try {
			$namespaces = self::USER_NAMESPACES;
			$dbr = wfGetDB( DB_SLAVE );
			$userPages = $dbr->select(
				'page',
				['page_id', 'page_namespace', 'page_title'],
				['page_namespace' => $namespaces, 'page_title' . $dbr->buildLike( $username, $dbr->anyString() )],
				__METHOD__ );
			foreach( $userPages as $page ) {
				$title = Title::newFromRow( $page );
				PermanentArticleDelete::deletePage( $title );
			}
			$this->info( "Removed user pages", ['username' => $username] );
			return true;
		} catch ( Exception $error ) {
			$this->error( "Couldn't remove user pages", ['exception' => $error, 'username' => $username] );
			return true;
		}
	}

	public function removeAllData( $userId, $username ) {
		$rmcu = $this->removeCheckUserData( $userId );
		$rmaf = $this->removeAbuseFilterData( $userId );
		$rmrc = $this->removeIpFromRecentChanges( $userId );
		$rmup = $this->removeUserPages( $username );
		return $rmaf && $rmcu && $rmrc && $rmup;
	}

	protected function getLoggerContext() {
		// make right to be forgotten logs more searchable
		return ['right_to_be_forgotten' => 1];
	}

}