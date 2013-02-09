<?php

require_once 'lib/PicoFeed/Parser.php';

use PicoFeed\Rss20;

class Rss20ParserTest extends PHPUnit_Framework_TestCase
{
    public function testFormatOk()
    {
        $parser = new Rss20(file_get_contents('tests/fixtures/rss2sample.xml'));
        $r = $parser->execute();

        $this->assertEquals('Liftoff News', $r->title);
        $this->assertEquals('http://liftoff.msfc.nasa.gov/', $r->url);
        $this->assertEquals('http://liftoff.msfc.nasa.gov/', $r->id);
        $this->assertEquals('1055217600', $r->updated);
        $this->assertEquals(4, count($r->items));

        $this->assertEquals('Star City', $r->items[0]->title);
        $this->assertEquals('http://liftoff.msfc.nasa.gov/news/2003/news-starcity.asp', $r->items[0]->url);
        $this->assertEquals('http://liftoff.msfc.nasa.gov/2003/06/03.html#item573', $r->items[0]->id);
        $this->assertEquals('1054633161', $r->items[0]->updated);
        $this->assertEquals('webmaster@example.com', $r->items[0]->author);
        $this->assertEquals(224, strlen($r->items[0]->content));

        $parser = new Rss20(file_get_contents('tests/fixtures/rss20.xml'));
        $r = $parser->execute();

        $this->assertEquals('WordPress News', $r->title);
        $this->assertEquals('http://wordpress.org/news', $r->url);
        $this->assertEquals('http://wordpress.org/news', $r->id);
        $this->assertEquals('1359066183', $r->updated);
        $this->assertEquals(10, count($r->items));

        $this->assertEquals('WordPress 3.4.2 Maintenance and Security Release', $r->items[9]->title);
        $this->assertEquals('http://wordpress.org/news/2012/09/wordpress-3-4-2/', $r->items[9]->url);
        $this->assertEquals('http://wordpress.org/news/?p=2426', $r->items[9]->id);
        $this->assertEquals('1346962041', $r->items[9]->updated);
        $this->assertEquals('Andrew Nacin', $r->items[9]->author);
        $this->assertEquals(1443, strlen($r->items[9]->content));
    }


    public function testBadInput()
    {
        $parser = new Rss20('ffhhghg');
        $r = $parser->execute();

        $this->assertEquals('', $r->title);
    }
}