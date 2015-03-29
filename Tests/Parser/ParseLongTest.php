<?php

namespace Forti\Bundle\BbcodeBundle\Tests\Parser;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;
use Forti\Bundle\BbcodeBundle\Parser\Parser;

class ParseLongTest extends WebTestCase
{
    private $parser = false;

    public function setUp()
    {
        $this->parser = new Parser();
    }

    public function testLongText()
    {
        $expected = file_get_contents(__DIR__.'../../Fixtures/Parsed/ParsedText.txt');
        $text = file_get_contents(__DIR__.'../../Fixtures/Bbcode/BbcodeText.txt');

        $parsed = $this->parser->parse($text);

        $this->assertEquals($expected, $parsed);
    }

    public function testFailureLongText()
    {
        $expected = file_get_contents(__DIR__.'../../Fixtures/Parsed/ParsedText.txt');
        $text = file_get_contents(__DIR__.'../../Fixtures/Bbcode/BbcodeWrongText.txt');

        $parsed = $this->parser->parse($text);

        $this->assertNotEquals($expected, $parsed);
    }
}