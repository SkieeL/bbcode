<?php

namespace Forti\bbcode\Parser\Tags;

use Forti\bbcode\Parser\Tags\TagInterface;
use Forti\bbcode\Parser\Tags\AbstractTag;

class TagPre extends AbstractTag implements TagInterface
{
    private $config = [];
    private $parsed = false;
    private $tag = array(
        'from' => array(
            "[pre]",
            "[/pre]"
        ),
        'to' => array(
            '<pre class="">',
            '</pre>'
        )
    );

    public function __construct(array $config = [])
    {
        $this->config = $config;

        $toOpen = $this->tag['to'][0];
        $toOpen = str_replace('class=""', "class=\"{$config['class']}\"", $toOpen);
        $this->tag['to'][0] = $toOpen;
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