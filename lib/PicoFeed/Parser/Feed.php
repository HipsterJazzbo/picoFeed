<?php

namespace PicoFeed\Parser;

/**
 * Feed.
 *
 * @package PicoFeed\Parser
 * @author  Frederic Guillot
 */
class Feed extends Entity
{
    /**
     * Feed items.
     *
     * @var Item[]
     */
    public $items = array();

    /**
     * Feed description.
     *
     * @var string
     */
    public $description = '';

    /**
     * Feed url.
     *
     * @var string
     */
    public $feedUrl = '';

    /**
     * Site url.
     *
     * @var string
     */
    public $siteUrl = '';

    /**
     * Feed date.
     *
     * @var \DateTime
     */
    public $date = null;

    /**
     * Feed logo URL.
     *
     * @var string
     */
    public $logo = '';

    /**
     * Feed icon URL.
     *
     * @var string
     */
    public $icon = '';

    /**
     * Return feed information.
     */
    public function __toString()
    {
        $output = '';

        foreach (array('id', 'title', 'feedUrl', 'siteUrl', 'language', 'description', 'logo') as $property) {
            $output .= 'Feed::'.$property.' = '.$this->$property.PHP_EOL;
        }

        $output .= 'Feed::date = '.$this->date->format(DATE_RFC822).PHP_EOL;
        $output .= 'Feed::isRTL() = '.($this->isRTL() ? 'true' : 'false').PHP_EOL;
        $output .= 'Feed::items = '.count($this->items).' items'.PHP_EOL;

        foreach ($this->items as $item) {
            $output .= '----'.PHP_EOL;
            $output .= $item;
        }

        return $output;
    }

    /**
     * Get description.
     */
    public function getDescription()
    {
        return $this->description;
    }

    /**
     * Get the logo url.
     */
    public function getLogo()
    {
        return $this->logo;
    }

    /**
     * Get the icon url.
     */
    public function getIcon()
    {
        return $this->icon;
    }

    /**
     * Get feed url.
     */
    public function getFeedUrl()
    {
        return $this->feedUrl;
    }

    /**
     * Get site url.
     */
    public function getSiteUrl()
    {
        return $this->siteUrl;
    }

    /**
     * Get date.
     */
    public function getDate()
    {
        return $this->date;
    }

    /**
     * Get feed items.
     */
    public function getItems()
    {
        return $this->items;
    }

    /**
     * Set feed items.
     *
     * @param  Item[] $items
     * @return Feed
     */
    public function setItems(array $items)
    {
        $this->items = $items;
        return $this;
    }

    /**
     * Set feed description.
     *
     * @param string $description
     * @return Feed
     */
    public function setDescription($description)
    {
        $this->description = $description;
        return $this;
    }

    /**
     * Set feed url.
     *
     * @param string $feedUrl
     * @return Feed
     */
    public function setFeedUrl($feedUrl)
    {
        $this->feedUrl = $feedUrl;
        return $this;
    }

    /**
     * Set feed website url.
     *
     * @param string $siteUrl
     * @return Feed
     */
    public function setSiteUrl($siteUrl)
    {
        $this->siteUrl = $siteUrl;
        return $this;
    }

    /**
     * Set feed date.
     *
     * @param \DateTime $date
     * @return Feed
     */
    public function setDate($date)
    {
        $this->date = $date;
        return $this;
    }

    /**
     * Set feed logo.
     *
     * @param string $logo
     * @return Feed
     */
    public function setLogo($logo)
    {
        $this->logo = $logo;
        return $this;
    }

    /**
     * Set feed icon.
     *
     * @param string $icon
     * @return Feed
     */
    public function setIcon($icon)
    {
        $this->icon = $icon;
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

        return $query = './/'.$tag.'[not(ancestor::item)]'.$attribute;
    }
}
