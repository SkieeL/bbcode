<?php

namespace Forti\bbcode\Parser;

use Forti\bbcode\Parser\Tags\TagFactory;

abstract class AbstractParser
{
    private $parsed = false;

    /** @var array */
    protected $config = [];

    public function __construct(array $config = [])
    {
        $this->config = $config;
    }

    protected function single($text)
    {
        $this->tagFactory($text);

        return $this->parsed;
    }

    protected function tagFactory($text)
    {
        $tag = new TagFactory($text, $this->config);
        $tag->parse();
        $this->parsed = $tag->getParsed();
    }
}