<?php
namespace Wikia\PortableInfobox\Parser\Nodes;

use Wikia\PortableInfobox\Helpers\SimpleXmlUtil;
use Wikia\PortableInfobox\Parser\ExternalParser;
use Wikia\PortableInfobox\Parser\SimpleParser;

class Node {

	const DATA_SRC_ATTR_NAME = 'source';
	const DEFAULT_TAG_NAME = 'default';
	const VALUE_TAG_NAME = 'value';
	const LABEL_TAG_NAME = 'label';

	protected $xmlNode;
	protected $parent = null;
	protected $data = null;

	/* @var $externalParser ExternalParser */
	protected $externalParser;

	public function __construct( \SimpleXMLElement $xmlNode, $infoboxData ) {
		$this->xmlNode = $xmlNode;
		$this->infoboxData = $infoboxData;
	}

	/**
	 * @return mixed
	 */
	public function getParent() {
		return $this->parent;
	}

	/**
	 * @param mixed $parent
	 */
	public function setParent( Node $parent ) {
		$this->parent = $parent;
	}

	public function ignoreNodeWhenEmpty() {
		return true;
	}

	public function getSource() {
		$source = $this->getXmlAttribute( $this->xmlNode, self::DATA_SRC_ATTR_NAME );
		if ( $this->xmlNode->{self::DEFAULT_TAG_NAME} ) {
			preg_match_all( '/{{{(.*)}}}/sU', (string)$this->xmlNode->{self::DEFAULT_TAG_NAME}, $sources );


			return $source ? array_unique( $sources[ 1 ] + [ $source ] ) : array_unique( $sources[ 1 ] );
		}

		return $source ? [ $source ] : [ ];
	}

	/**
	 * @return ExternalParser
	 */
	public function getExternalParser() {
		if ( !isset( $this->externalParser ) ) {
			$this->setExternalParser( new SimpleParser() );
		}

		return $this->externalParser;
	}

	/**
	 * @param mixed $externalParser
	 *
	 * @return $this
	 */
	public function setExternalParser( ExternalParser $externalParser ) {
		$this->externalParser = $externalParser;

		return $this;
	}

	public function getType() {
		/*
		 * Node type generation is based on XML tag name.
		 * It's worth to remember that SimpleXMLElement::getName method is
		 * case - sensitive ( "<Data>" != "<data>" ), so we need to sanitize Node Type
		 * by using strtolower function
		 */
		return strtolower( $this->xmlNode->getName() );
	}

	public function getData() {
		if ( !isset( $this->data ) ) {
			$this->data = [ 'value' => (string)$this->xmlNode ];
		}

		return $this->data;
	}

	/**
	 * @desc Check if node is empty.
	 * Note that a '0' value cannot be treated like a null
	 */
	public function isEmpty() {
		$data = $this->getData()[ 'value' ];

		return !( isset( $data ) ) || ( empty( $data ) && $data != '0' );
	}

	protected function getValueWithDefault( \SimpleXMLElement $xmlNode ) {
		$source = $this->getXmlAttribute( $xmlNode, self::DATA_SRC_ATTR_NAME );
		$value = null;
		if ( !empty( $source ) ) {
			$value = $this->getInfoboxData( $source );
		}
		if ( !$value ) {
			if ( $xmlNode->{self::DEFAULT_TAG_NAME} ) {
				/*
				 * <default> tag can contain <ref> or other WikiText parser hooks
				 * We should not parse it's contents as XML but return pure text in order to let MediaWiki Parser
				 * parse it.
				 */
				$value = SimpleXmlUtil::getInstance()->getInnerXML(
					$xmlNode->{self::DEFAULT_TAG_NAME}
				);
				$value = $this->getExternalParser()->parseRecursive( $value );
			}
		}

		return $value;
	}

	protected function getRawValueWithDefault( \SimpleXMLElement $xmlNode ) {
		$source = $this->getXmlAttribute( $xmlNode, self::DATA_SRC_ATTR_NAME );
		$value = null;
		if ( !empty( $source ) ) {
			$value = $this->getRawInfoboxData( $source );
		}
		if ( !$value ) {
			if ( $xmlNode->{self::DEFAULT_TAG_NAME} ) {
				$value = (string)$xmlNode->{self::DEFAULT_TAG_NAME};
				$value = $this->getExternalParser()->replaceVariables( $value );
			}
		}

		return $value;
	}

	protected function getXmlAttribute( \SimpleXMLElement $xmlNode, $attribute ) {
		if ( isset( $xmlNode[ $attribute ] ) ) {
			return (string)$xmlNode[ $attribute ];
		}

		return null;
	}

	protected function getRawInfoboxData( $key ) {
		$data = isset( $this->infoboxData[ $key ] ) ? $this->infoboxData[ $key ] : null;

		return $data;
	}

	protected function getInfoboxData( $key ) {
		return $this->getExternalParser()->parseRecursive( $this->getRawInfoboxData( $key ) );
	}
}
