<?php

namespace Forti\Bundle\BbcodeBundle\Parser\Tags;

use Forti\Bundle\BbcodeBundle\Parser\Tags\TagInterface;
use Forti\Bundle\BbcodeBundle\Parser\Tags\AbstractTag;

class TagImage extends AbstractTag implements TagInterface
{
    private $parsed = false;
    private $tags = array();
    private $style = array(
        '<img src="',
        '"></img>'
    );

    public function __construct()
    {
    }

    public function parse($text)
    {
        $this->setTags($text);
        $this->parsed = $this->replace($text);
    }

    public function getParsed()
    {
        return $this->parsed;
    }

    private function setTags($text)
    {
        $tags = array();
        preg_match_all('~(\[img\])(.*?)(\[\/img])~i', $text, $matches, PREG_SET_ORDER);

        foreach ($matches as $match) {
            $tags[] = array(
                'from' => $match[1],
                'end' => $match[3]
            );
        }
        $this->tags = $tags;
    }

    private function replace($text)
    {
        $parsed = $text;
        foreach ($this->tags as $tag) {
            $parsed = str_replace($tag['from'], $this->style[0], $parsed);
            $parsed = str_replace($tag['end'], $this->style[1], $parsed);
        }

        return $parsed;
    }
}