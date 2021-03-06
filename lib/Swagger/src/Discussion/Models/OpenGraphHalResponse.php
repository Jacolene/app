<?php
/**
 * OpenGraphHalResponse
 *
 * PHP version 5
 *
 * @category Class
 * @package  Swagger\Client
 * @author   http://github.com/swagger-api/swagger-codegen
 * @license  http://www.apache.org/licenses/LICENSE-2.0 Apache Licene v2
 * @link     https://github.com/swagger-api/swagger-codegen
 */

/**
 * discussion
 *
 * OpenAPI spec version: 0.1-SNAPSHOT
 * 
 * Generated by: https://github.com/swagger-api/swagger-codegen.git
 *
 * Licensed under the Apache License, Version 2.0 (the "License");
 * you may not use this file except in compliance with the License.
 * You may obtain a copy of the License at
 *
 *      http://www.apache.org/licenses/LICENSE-2.0
 *
 * Unless required by applicable law or agreed to in writing, software
 * distributed under the License is distributed on an "AS IS" BASIS,
 * WITHOUT WARRANTIES OR CONDITIONS OF ANY KIND, either express or implied.
 * See the License for the specific language governing permissions and
 * limitations under the License.
 */

/**
 * NOTE: This class is auto generated by the swagger code generator program.
 * https://github.com/swagger-api/swagger-codegen
 * Do not edit the class manually.
 */

namespace Swagger\Client\Discussion\Models;

use \ArrayAccess;

/**
 * OpenGraphHalResponse Class Doc Comment
 *
 * @category    Class
 * @package     Swagger\Client
 * @author      http://github.com/swagger-api/swagger-codegen
 * @license     http://www.apache.org/licenses/LICENSE-2.0 Apache Licene v2
 * @link        https://github.com/swagger-api/swagger-codegen
 */
class OpenGraphHalResponse implements ArrayAccess
{
    /**
      * The original name of the model.
      * @var string
      */
    protected static $swaggerModelName = 'OpenGraphHalResponse';

    /**
      * Array of property to type mappings. Used for (de)serialization
      * @var string[]
      */
    protected static $swaggerTypes = array(
        'type' => 'string',
        'site_id' => 'int',
        'title' => 'string',
        'description' => 'string',
        'date_retrieved' => '\Swagger\Client\Discussion\Models\Instant',
        'image_url' => 'string',
        'url' => 'string',
        'site_name' => 'string',
        '_links' => '\Swagger\Client\Discussion\Models\HalLinks',
        'requester_id' => 'string',
        '_embedded' => '\Swagger\Client\Discussion\Models\Embeddable[]'
    );

    public static function swaggerTypes()
    {
        return self::$swaggerTypes;
    }

    /**
     * Array of attributes where the key is the local name, and the value is the original name
     * @var string[]
     */
    protected static $attributeMap = array(
        'type' => 'type',
        'site_id' => 'siteId',
        'title' => 'title',
        'description' => 'description',
        'date_retrieved' => 'dateRetrieved',
        'image_url' => 'imageUrl',
        'url' => 'url',
        'site_name' => 'siteName',
        '_links' => '_links',
        'requester_id' => 'requesterId',
        '_embedded' => '_embedded'
    );

    public static function attributeMap()
    {
        return self::$attributeMap;
    }

    /**
     * Array of attributes to setter functions (for deserialization of responses)
     * @var string[]
     */
    protected static $setters = array(
        'type' => 'setType',
        'site_id' => 'setSiteId',
        'title' => 'setTitle',
        'description' => 'setDescription',
        'date_retrieved' => 'setDateRetrieved',
        'image_url' => 'setImageUrl',
        'url' => 'setUrl',
        'site_name' => 'setSiteName',
        '_links' => 'setLinks',
        'requester_id' => 'setRequesterId',
        '_embedded' => 'setEmbedded'
    );

    public static function setters()
    {
        return self::$setters;
    }

    /**
     * Array of attributes to getter functions (for serialization of requests)
     * @var string[]
     */
    protected static $getters = array(
        'type' => 'getType',
        'site_id' => 'getSiteId',
        'title' => 'getTitle',
        'description' => 'getDescription',
        'date_retrieved' => 'getDateRetrieved',
        'image_url' => 'getImageUrl',
        'url' => 'getUrl',
        'site_name' => 'getSiteName',
        '_links' => 'getLinks',
        'requester_id' => 'getRequesterId',
        '_embedded' => 'getEmbedded'
    );

    public static function getters()
    {
        return self::$getters;
    }

    

    

    /**
     * Associative array for storing property values
     * @var mixed[]
     */
    protected $container = array();

    /**
     * Constructor
     * @param mixed[] $data Associated array of property value initalizing the model
     */
    public function __construct(array $data = null)
    {
        $this->container['type'] = isset($data['type']) ? $data['type'] : null;
        $this->container['site_id'] = isset($data['site_id']) ? $data['site_id'] : null;
        $this->container['title'] = isset($data['title']) ? $data['title'] : null;
        $this->container['description'] = isset($data['description']) ? $data['description'] : null;
        $this->container['date_retrieved'] = isset($data['date_retrieved']) ? $data['date_retrieved'] : null;
        $this->container['image_url'] = isset($data['image_url']) ? $data['image_url'] : null;
        $this->container['url'] = isset($data['url']) ? $data['url'] : null;
        $this->container['site_name'] = isset($data['site_name']) ? $data['site_name'] : null;
        $this->container['_links'] = isset($data['_links']) ? $data['_links'] : null;
        $this->container['requester_id'] = isset($data['requester_id']) ? $data['requester_id'] : null;
        $this->container['_embedded'] = isset($data['_embedded']) ? $data['_embedded'] : null;
    }

    /**
     * show all the invalid properties with reasons.
     *
     * @return array invalid properties with reasons
     */
    public function listInvalidProperties()
    {
        $invalid_properties = array();
        if ($this->container['_links'] === null) {
            $invalid_properties[] = "'_links' can't be null";
        }
        return $invalid_properties;
    }

    /**
     * validate all the properties in the model
     * return true if all passed
     *
     * @return bool True if all properteis are valid
     */
    public function valid()
    {
        if ($this->container['_links'] === null) {
            return false;
        }
        return true;
    }


    /**
     * Gets type
     * @return string
     */
    public function getType()
    {
        return $this->container['type'];
    }

    /**
     * Sets type
     * @param string $type
     * @return $this
     */
    public function setType($type)
    {
        $this->container['type'] = $type;

        return $this;
    }

    /**
     * Gets site_id
     * @return int
     */
    public function getSiteId()
    {
        return $this->container['site_id'];
    }

    /**
     * Sets site_id
     * @param int $site_id
     * @return $this
     */
    public function setSiteId($site_id)
    {
        $this->container['site_id'] = $site_id;

        return $this;
    }

    /**
     * Gets title
     * @return string
     */
    public function getTitle()
    {
        return $this->container['title'];
    }

    /**
     * Sets title
     * @param string $title
     * @return $this
     */
    public function setTitle($title)
    {
        $this->container['title'] = $title;

        return $this;
    }

    /**
     * Gets description
     * @return string
     */
    public function getDescription()
    {
        return $this->container['description'];
    }

    /**
     * Sets description
     * @param string $description
     * @return $this
     */
    public function setDescription($description)
    {
        $this->container['description'] = $description;

        return $this;
    }

    /**
     * Gets date_retrieved
     * @return \Swagger\Client\Discussion\Models\Instant
     */
    public function getDateRetrieved()
    {
        return $this->container['date_retrieved'];
    }

    /**
     * Sets date_retrieved
     * @param \Swagger\Client\Discussion\Models\Instant $date_retrieved
     * @return $this
     */
    public function setDateRetrieved($date_retrieved)
    {
        $this->container['date_retrieved'] = $date_retrieved;

        return $this;
    }

    /**
     * Gets image_url
     * @return string
     */
    public function getImageUrl()
    {
        return $this->container['image_url'];
    }

    /**
     * Sets image_url
     * @param string $image_url
     * @return $this
     */
    public function setImageUrl($image_url)
    {
        $this->container['image_url'] = $image_url;

        return $this;
    }

    /**
     * Gets url
     * @return string
     */
    public function getUrl()
    {
        return $this->container['url'];
    }

    /**
     * Sets url
     * @param string $url
     * @return $this
     */
    public function setUrl($url)
    {
        $this->container['url'] = $url;

        return $this;
    }

    /**
     * Gets site_name
     * @return string
     */
    public function getSiteName()
    {
        return $this->container['site_name'];
    }

    /**
     * Sets site_name
     * @param string $site_name
     * @return $this
     */
    public function setSiteName($site_name)
    {
        $this->container['site_name'] = $site_name;

        return $this;
    }

    /**
     * Gets _links
     * @return \Swagger\Client\Discussion\Models\HalLinks
     */
    public function getLinks()
    {
        return $this->container['_links'];
    }

    /**
     * Sets _links
     * @param \Swagger\Client\Discussion\Models\HalLinks $_links
     * @return $this
     */
    public function setLinks($_links)
    {
        $this->container['_links'] = $_links;

        return $this;
    }

    /**
     * Gets requester_id
     * @return string
     */
    public function getRequesterId()
    {
        return $this->container['requester_id'];
    }

    /**
     * Sets requester_id
     * @param string $requester_id
     * @return $this
     */
    public function setRequesterId($requester_id)
    {
        $this->container['requester_id'] = $requester_id;

        return $this;
    }

    /**
     * Gets _embedded
     * @return \Swagger\Client\Discussion\Models\Embeddable[]
     */
    public function getEmbedded()
    {
        return $this->container['_embedded'];
    }

    /**
     * Sets _embedded
     * @param \Swagger\Client\Discussion\Models\Embeddable[] $_embedded
     * @return $this
     */
    public function setEmbedded($_embedded)
    {
        $this->container['_embedded'] = $_embedded;

        return $this;
    }
    /**
     * Returns true if offset exists. False otherwise.
     * @param  integer $offset Offset
     * @return boolean
     */
    public function offsetExists($offset)
    {
        return isset($this->container[$offset]);
    }

    /**
     * Gets offset.
     * @param  integer $offset Offset
     * @return mixed
     */
    public function offsetGet($offset)
    {
        return isset($this->container[$offset]) ? $this->container[$offset] : null;
    }

    /**
     * Sets value based on offset.
     * @param  integer $offset Offset
     * @param  mixed   $value  Value to be set
     * @return void
     */
    public function offsetSet($offset, $value)
    {
        if (is_null($offset)) {
            $this->container[] = $value;
        } else {
            $this->container[$offset] = $value;
        }
    }

    /**
     * Unsets offset.
     * @param  integer $offset Offset
     * @return void
     */
    public function offsetUnset($offset)
    {
        unset($this->container[$offset]);
    }

    /**
     * Gets the string presentation of the object
     * @return string
     */
    public function __toString()
    {
        if (defined('JSON_PRETTY_PRINT')) { // use JSON pretty print
            return json_encode(\Swagger\Client\ObjectSerializer::sanitizeForSerialization($this), JSON_PRETTY_PRINT);
        }

        return json_encode(\Swagger\Client\ObjectSerializer::sanitizeForSerialization($this));
    }
}


