<?php

namespace Forti\Bundle\BbcodeBundle\Parser;

use Forti\Bundle\BbcodeBundle\Parser\AbstractParser;
use Forti\Bundle\BbcodeBundle\Parser\Tags\TagFactory;

class Parser extends AbstractParser
{
    public function __construct()
    {
        parent::__construct();
    }

    public function single($text)
    {
        foreach ($this->tags as $tag) {
            if (strpos($text, $tag)) {
                preg_match("/([a-zA-Z]+)/", $tag, $match);
                $this->found[$match[1]] = $text;
            }
        }
        $this->tagFactory();

        if (!$this->parsed) {
            return $text;
        }
        return $this->parsed;
    }

    private function tagFactory()
    {
        $tag = new TagFactory($this->found);
        $tag->parse();
        $this->parsed = $tag->getParsed();
    }
}
