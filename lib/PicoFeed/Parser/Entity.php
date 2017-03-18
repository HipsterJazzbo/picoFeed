<?php

namespace PicoFeed\Parser;

abstract class Entity
{
    /**
     * Raw XML.
     *
     * @var \SimpleXMLElement
     */
    public $xml;

    /**
     * List of namespaces.
     *
     * @var array
     */
    public $namespaces = array();

    /**
     * Item language.
     *
     * @var string
     */
    public $language = '';

    /**
     * Feed id.
     *
     * @var string
     */
    public $id = '';

    /**
     * Feed title.
     *
     * @var string
     */
    public $title = '';

    /**
     * Get raw XML.
     *
     * @return \SimpleXMLElement
     */
    public function getXml()
    {
        return $this->xml;
    }

    /**
     * Get specific XML tag or attribute value.
     *
     * @param string $tag       Tag name (examples: guid, media:content)
     * @param string $attribute Tag attribute
     *
     * @return array|false Tag values or error
     */
    public function getTag($tag, $attribute = '')
    {
        $query    = $this->getQuery($tag, $attribute);
        $elements = XmlParser::getXPathResult($this->xml, $query, $this->namespaces);

        if ($elements === false) { // xPath error
            return false;
        }

        return array_map(function ($element) {
            return (string)$element;
        }, $elements);
    }

    /**
     * Check if a XML namespace exists
     *
     * @access public
     * @param  string $namespace
     * @return bool
     */
    public function hasNamespace($namespace)
    {
        return array_key_exists($namespace, $this->namespaces);
    }

    /**
     * Get XML namespaces.
     *
     * @return array
     */
    public function getNamespaces()
    {
        return $this->namespaces;
    }

    /**
     * Get language.
     *
     * @return string
     */
    public function getLanguage()
    {
        return $this->language;
    }

    /**
     * Get id.
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Get title.
     */
    public function getTitle()
    {
        return $this->title;
    }

    /**
     * Set raw XML.
     *
     * @param \SimpleXMLElement $xml
     * @return static
     */
    public function setXml($xml)
    {
        $this->xml = $xml;
        return $this;
    }

    /**
     * Set XML namespaces.
     *
     * @param array $namespaces
     * @return static
     */
    public function setNamespaces($namespaces)
    {
        $this->namespaces = $namespaces;
        return $this;
    }

    /**
     * Set item language.
     *
     * @param string $language
     * @return static
     */
    public function setLanguage($language)
    {
        $this->language = $language;
        return $this;
    }

    /**
     * Set feed id.
     *
     * @param  string $id
     * @return static
     */
    public function setId($id)
    {
        $this->id = $id;
        return $this;
    }

    /**
     * Set feed title.
     *
     * @param string $title
     * @return static
     */
    public function setTitle($title)
    {
        $this->title = $title;
        return $this;
    }

    /**
     * Return true if the item is "Right to Left".
     *
     * @return bool
     */
    public function isRTL()
    {
        return Parser::isLanguageRTL($this->language);
    }

    /**
     * Get the appropriate Xpath query.
     *
     * @param string $tag
     * @param string $attribute
     * @return string
     */
    abstract public function getQuery($tag, $attribute = '');
}
