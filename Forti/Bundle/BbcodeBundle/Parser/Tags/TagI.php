<?php

namespace Forti\Bundle\BbcodeBundle\Parser\Tags;

use Forti\Bundle\BbcodeBundle\Parser\Tags\TagInterface;

class TagI implements TagInterface
{
    private $text = false;
    private $parsed = false;
    private $tag = array(
        'from' => array("[i]", "[/i]"),
        'to' => array("<i>", "</i>"),
    );

    public function __construct($text)
    {
        $this->text = $text;
        $this->parse();
    }

    public function getParsed()
    {
        return $this->parsed;
    }

    private function parse()
    {
        $parsed = str_replace($this->tag['from'], $this->tag['to'], $this->text);
        $this->parsed = $parsed;
    }
}