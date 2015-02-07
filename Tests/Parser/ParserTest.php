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
        $text = "some <b>text b</b>";
        $unparsed = "some [b]text b[/b]";

        $parsed = $this->parser->single($unparsed);

        $this->assertEquals($text, $parsed);
    }

    public function testItalic()
    {
        $text = "some <i>text </i>";
        $unparsed = "some [i]text [/i]";

        $parsed = $this->parser->single($unparsed);

        $this->assertEquals($text, $parsed);
    }

    public function testUnderLine()
    {
        $text = 'some <span style="text-decoration: underline">text </span>';
        $unparsed = "some [u]text [/u]";

        $parsed = $this->parser->single($unparsed);

        $this->assertEquals($text, $parsed);
    }

    public function testMultiTags()
    {
        $parsed = 'some <b>bold </b>, <i>Italic</i>, <span style="text-decoration: underline">Underline</span>';
        $text = "some [b]bold [/b], [i]Italic[/i], [u]Underline[/u]";

        $parsedText = $this->parser->single($text);

        $this->assertEquals($parsed, $parsedText);
    }

    public function testFakeTag()
    {
        $text = "this is some [fake] tag [/fake]";

        $parsed = $this->parser->single($text);

        $this->assertEquals($text, $parsed);
    }
}