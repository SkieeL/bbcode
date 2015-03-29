<?php

namespace Forti\bbcode\Parser\Tags;

use Forti\bbcode\Parser\Tags\TagInterface;
use Forti\bbcode\Parser\Tags\AbstractTag;

class TagYouTube extends AbstractTag implements TagInterface
{
    private $parsed = false;
    private $tags = array();
    private $style = array(
        '<iframe width="{width}" height="{height}" frameborder="{frameborder}" title="{title}" src="',
        '">'
    );
    private $config = array(
        'height' => 480,
        'width' => 640,
        'frameborder' => 0,
        'title' => "YouTube video player"
    );
    private $toReplace = array(
        '{height}',
        '{width}',
        '{frameborder}',
        '{title}'
    );

    public function __construct()
    {
        $this->style[0] = str_replace($this->toReplace, $this->config, $this->style[0]);
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
        preg_match_all('~(\[youtube\])(.*?)(\[\/youtube])~i', $text, $matches, PREG_SET_ORDER);

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
            $parsed = str_replace('[/youtube]', $this->style[1].'</iframe>', $parsed);
        }

        return $parsed;
    }
}