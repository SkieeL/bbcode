<?php

namespace Forti\Bundle\BbcodeBundle\Tests\Parser;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;
use Forti\Bundle\BbcodeBundle\Parser\Parser;

class ParserTest extends WebTestCase
{
    private $parser = false;

    public function setUp()
    {
        $this->parser = new Parser();
    }

    public function testBold()
    {
        $expected = "some <b>text b</b>";
        $unparsed = "some [b]text b[/b]";

        $parsed = $this->parser->parse($unparsed);

        $this->assertEquals($expected, $parsed);
    }

    public function testItalic()
    {
        $expected = "some <i>text </i>";
        $unparsed = "some [i]text [/i]";

        $parsed = $this->parser->parse($unparsed);

        $this->assertEquals($expected, $parsed);
    }

    public function testUnderLine()
    {
        $expected = '<span style="text-decoration: underline">text </span>';
        $unparsed = "[u]text [/u]";

        $parsed = $this->parser->parse($unparsed);

        $this->assertEquals($expected, $parsed);
    }

    public function testMultiTags()
    {
        $expected = 'some <b>bold </b>, <i>Italic</i>, <span style="text-decoration: underline">Underline</span>, <b> bold again </b>';
        $text = "some [b]bold [/b], [i]Italic[/i], [u]Underline[/u], [b] bold again [/b]";

        $parsedText = $this->parser->parse($text);

        $this->assertEquals($expected, $parsedText);
    }

    public function testFakeTag()
    {
        $text = "this is some [fake] tag [/fake]";

        $parsed = $this->parser->parse($text);

        $this->assertEquals($text, $parsed);
    }

    public function testColor()
    {
        $text = "this is [color=#000000] tag [/color] some [color=red] tag [/color]";
        $expected = 'this is <span style="color:#000000"> tag </span> some <span style="color:red"> tag </span>';

        $parsed = $this->parser->parse($text);

        $this->assertEquals($expected, $parsed);
    }

    public function testUrl()
    {
        $text = "[url=http://arturs.pl]link[/url]";
        $expected = '<a href="http://arturs.pl">link</a>';

        $parsed = $this->parser->parse($text);

        $this->assertEquals($expected, $parsed);
    }

    public function testUrlandTarget()
    {
        $text = "[url=http://arturs.pl target=_blank]link[/url]";
        $expected = '<a href="http://arturs.pl" target="_blank">link</a>';

        $parsed = $this->parser->parse($text);

        $this->assertEquals($expected, $parsed);
    }
}