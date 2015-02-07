<?php

namespace Forti\Bundle\BbcodeBundle\Parser\Tags;

use Forti\Bundle\BbcodeBundle\Parser\Tags\TagInterface;

class TagB implements TagInterface
{
    private $parsed = false;
    private $tag = array(
        'from' => array("[b]", "[/b]"),
        'to' => array("<b>", "</b>"),
    );

    public function __construct()
    {
    }

    public function parse($text)
    {
        $parsed = str_replace($this->tag['from'], $this->tag['to'], $text);
        $this->parsed = $parsed;
    }

    public function getParsed()
    {
        return $this->parsed;
    }
}