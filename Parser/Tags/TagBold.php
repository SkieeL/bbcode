<?php

namespace Forti\bbcode\Parser\Tags;

use Forti\bbcode\Parser\Tags\TagInterface;
use Forti\bbcode\Parser\Tags\AbstractTag;

class TagBold extends AbstractTag implements TagInterface
{
    private $parsed = false;
    private $tag = array(
        'from' => array("[b]", "[/b]"),
        'to' => array("<b>", "</b>"),
    );

    public function __construct(array $config = [])
    {
    }

    public function parse($text)
    {
        if ($this->validate($this->tag['from'], $text)) {
            $parsed = str_replace($this->tag['from'], $this->tag['to'], $text);
            $this->parsed = $parsed;
        } else {
            $this->parsed = $text;
        }
    }

    public function getParsed()
    {
        return $this->parsed;
    }
}