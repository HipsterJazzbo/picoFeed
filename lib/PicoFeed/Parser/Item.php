<?php

namespace PicoFeed\Parser;

/**
 * Feed Item.
 *
 * @package PicoFeed\Parser
 * @author  Frederic Guillot
 */
class Item extends Entity
{
    /**
     * List of known RTL languages.
     *
     * @var string[]
     */
    public $rtl = array(
        'ar',  // Arabic (ar-**)
        'fa',  // Farsi (fa-**)
        'ur',  // Urdu (ur-**)
        'ps',  // Pashtu (ps-**)
        'syr', // Syriac (syr-**)
        'dv',  // Divehi (dv-**)
        'he',  // Hebrew (he-**)
        'yi',  // Yiddish (yi-**)
    );

    /**
     * Item id.
     *
     * @var string
     */
    public $id = '';

    /**
     * Item title.
     *
     * @var string
     */
    public $title = '';

    /**
     * Item url.
     *
     * @var string
     */
    public $url = '';

    /**
     * Item author.
     *
     * @var string
     */
    public $author = '';

    /**
     * Item date.
     *
     * @var \DateTime
     */
    public $date = null;

    /**
     * Item published date.
     *
     * @var \DateTime
     */
    public $publishedDate = null;

    /**
     * Item updated date.
     *
     * @var \DateTime
     */
    public $updatedDate = null;

    /**
     * Item content.
     *
     * @var string
     */
    public $content = '';

    /**
     * Item enclosure url.
     *
     * @var string
     */
    public $enclosureUrl = '';

    /**
     * Item enclusure type.
     *
     * @var string
     */
    public $enclosureType = '';

    /**
     * Return item information.
     *
     * @return string
     */
    public function __toString()
    {
        $output = '';

        foreach (array('id', 'title', 'url', 'language', 'author', 'enclosureUrl', 'enclosureType') as $property) {
            $output .= 'Item::'.$property.' = '.$this->$property.PHP_EOL;
        }

        $publishedDate = $this->publishedDate != null ? $this->publishedDate->format(DATE_RFC822) : null;
        $updatedDate = $this->updatedDate != null ? $this->updatedDate->format(DATE_RFC822) : null;

        $output .= 'Item::date = '.$this->date->format(DATE_RFC822).PHP_EOL;
        $output .= 'Item::publishedDate = '.$publishedDate.PHP_EOL;
        $output .= 'Item::updatedDate = '.$updatedDate.PHP_EOL;
        $output .= 'Item::isRTL() = '.($this->isRTL() ? 'true' : 'false').PHP_EOL;
        $output .= 'Item::content = '.strlen($this->content).' bytes'.PHP_EOL;

        return $output;
    }

    /**
     * Get URL
     *
     * @access public
     * @return string
     */
    public function getUrl()
    {
        return $this->url;
    }

    /**
     * Set URL
     *
     * @access public
     * @param  string $url
     * @return Item
     */
    public function setUrl($url)
    {
        $this->url = $url;
        return $this;
    }

    /**
     * Get date.
     *
     * @return \DateTime
     */
    public function getDate()
    {
        return $this->date;
    }

    /**
     * Get published date.
     *
     * @return \DateTime
     */
    public function getPublishedDate()
    {
        return $this->publishedDate;
    }

    /**
     * Get updated date.
     *
     * @return \DateTime
     */
    public function getUpdatedDate()
    {
        return $this->updatedDate;
    }

    /**
     * Get content.
     *
     * @return string
     */
    public function getContent()
    {
        return $this->content;
    }

    /**
     * Set content
     *
     * @access public
     * @param  string $value
     * @return Item
     */
    public function setContent($value)
    {
        $this->content = $value;
        return $this;
    }

    /**
     * Get enclosure url.
     *
     * @return string
     */
    public function getEnclosureUrl()
    {
        return $this->enclosureUrl;
    }

    /**
     * Get enclosure type.
     *
     * @return string
     */
    public function getEnclosureType()
    {
        return $this->enclosureType;
    }


    /**
     * Get author.
     *
     * @return string
     */
    public function getAuthor()
    {
        return $this->author;
    }

    /**
     * Set author.
     *
     * @param string $author
     * @return Item
     */
    public function setAuthor($author)
    {
        $this->author = $author;
        return $this;
    }

    /**
     * Set item date.
     *
     * @param \DateTime $date
     * @return Item
     */
    public function setDate($date)
    {
        $this->date = $date;
        return $this;
    }

    /**
     * Set item published date.
     *
     * @param \DateTime $publishedDate
     * @return Item
     */
    public function setPublishedDate($publishedDate)
    {
        $this->publishedDate = $publishedDate;
        return $this;
    }

    /**
     * Set item updated date.
     *
     * @param \DateTime $updatedDate
     * @return Item
     */
    public function setUpdatedDate($updatedDate)
    {
        $this->updatedDate = $updatedDate;
        return $this;
    }

    /**
     * Set enclosure url.
     *
     * @param string $enclosureUrl
     * @return Item
     */
    public function setEnclosureUrl($enclosureUrl)
    {
        $this->enclosureUrl = $enclosureUrl;
        return $this;
    }

    /**
     * Set enclosure type.
     *
     * @param string $enclosureType
     * @return Item
     */
    public function setEnclosureType($enclosureType)
    {
        $this->enclosureType = $enclosureType;
        return $this;
    }

    /**
     * Get the appropriate Xpath query.
     *
     * @param string $tag
     * @param string $attribute
     * @return string
     */
    public function getQuery($tag, $attribute = '')
    {
        if ($attribute !== '') {
            $attribute = '/@'.$attribute;
        }

        return $query = './/'.$tag.$attribute;
    }
}
