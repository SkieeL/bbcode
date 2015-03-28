<?php

namespace Forti\Bundle\BbcodeBundle\Tests\Parser\Tags;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;
use Forti\Bundle\BbcodeBundle\Parser\Tags\TagFactory;

class ParserTest extends WebTestCase
{
    public function testFactory()
    {
        $work = "some text with [b] u tag[/b]";
        $wrong = "some text with [b] u tag[/c]";

        $expected = "some text with <b> u tag</b>";

        $factory = new TagFactory($work);
        $factory->parse();
        $parsed = $factory->getParsed();

        $factory = new TagFactory($wrong);
        $factory->parse();
        $notParsed = $factory->getParsed();

        $this->assertEquals($expected, $parsed);
        $this->assertEquals($wrong, $notParsed);
    }
}