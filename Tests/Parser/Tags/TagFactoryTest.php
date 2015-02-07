<?php

namespace Forti\Bundle\BbcodeBundle\Tests\Parser\Tags;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;
use Forti\Bundle\BbcodeBundle\Parser\Tags\TagFactory;

class ParserTest extends WebTestCase
{
    public function testFactory()
    {
        $found = array(
            'b' => "some text with [b] u tag[/b]"
        );
        $wrong = array(
            'i' => "some text with [b] u tag[/b]"
        );

        $expected = "some text with <b> u tag</b>";

        $factory = new TagFactory($found);
        $factory->parse();

        $parsed = $factory->getParsed();

        $this->assertEquals($expected, $parsed);
        $this->assertNotEquals($wrong, $parsed);
    }
}