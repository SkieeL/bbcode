<?php

namespace Forti\Bundle\BbcodeBundle\Parser\Tags;

class TagFactory
{
    private $parsed = false;
    private $unParsed = false;

    public function __construct(array $found)
    {
        $this->unParsed = $found;
    }

    public function parse()
    {
        foreach ($this->unParsed as $tag => $text) {

            $tag = strtoupper($tag);
            $className = __NAMESPACE__ . "\\Tag{$tag}";

            if ($this->parsed) {
                $text = $this->parsed;
            }

            $class = new $className($text);
            $this->parsed = $class->getParsed();
        }
    }

    public function getParsed()
    {
        return $this->parsed;
    }
}