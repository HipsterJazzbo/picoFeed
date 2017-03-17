<?php

namespace PicoFeed\Parser;

use PHPUnit_Framework_TestCase;

class FeedTest extends PHPUnit_Framework_TestCase
{
    public function testLangRTL()
    {
        $item = new Feed();
        $item->language = 'fr_FR';
        $this->assertFalse($item->isRTL());

        $item->language = 'ur';
        $this->assertTrue($item->isRTL());

        $item->language = 'syr-**';
        $this->assertTrue($item->isRTL());

        $item->language = 'ru';
        $this->assertFalse($item->isRTL());
    }

    public function testGetTag()
    {
        $parser = new Rss20(file_get_contents('tests/fixtures/podbean.xml'));
        $feed = $parser->execute();
        $this->assertEquals(array('http://podbean.com/?v=3.2'), $feed->getTag('generator'));
        $this->assertTrue($feed->hasNamespace('itunes'));
        $this->assertEquals(array('http://imglogo.podbean.com/image-logo/586645/ATBLogo-BlackBackground.png'),  $feed->getTag('itunes:image', 'href'));
        $this->assertEquals(array(),  $feed->getTag('wfw:notExistent'));
        $this->assertCount(355, $feed->getTag('itunes:*'));
    }
}
