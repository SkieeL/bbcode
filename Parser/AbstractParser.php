<?php

namespace Forti\Bundle\BbcodeBundle\Parser;

use Forti\Bundle\BbcodeBundle\Parser\Tags\TagFactory;

abstract class AbstractParser
{
    private $parsed = false;

    public function __construct()
    {

    }

    protected function single($text)
    {
        $this->tagFactory($text);

        return $this->parsed;
    }

    protected function tagFactory($text)
    {
        $tag = new TagFactory($text);
        $tag->parse();
        $this->parsed = $tag->getParsed();
    }
}