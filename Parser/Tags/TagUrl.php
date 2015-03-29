<?php

namespace Forti\bbcode\Parser\Tags;

use Forti\bbcode\Parser\Tags\TagInterface;
use Forti\bbcode\Parser\Tags\AbstractTag;

class TagUrl extends AbstractTag implements TagInterface
{
    private $parsed = false;
    private $tags = array();
    private $href = false;
    private $style = array(
        '<a href="',
        '">'
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
        if (strpos($text, ' target=') !== false) {
            $this->setHrefAndTarget($text);
            $this->href = true;
        } else {
            $this->setOnlyHref($text);
        }
    }

    private function setHrefAndTarget($text)
    {
        $tags = array();
        preg_match_all('~(\[url=(.*?) |\[url=(.*?)])target=(.*?)]~i', $text, $matches, PREG_SET_ORDER);

        foreach ($matches as $match) {
            $tags[] = array(
                'url' => $match[2],
                'targetSearch' => ' target=' . $match[4] . ']',
                'targetReplace' => '" target="' . $match[4]
            );
        }

        $this->tags = $tags;
    }

    private function setOnlyHref($text)
    {
        $tags = array();
        preg_match_all('~\[url=(.*?)]~i', $text, $matches, PREG_SET_ORDER);

        foreach ($matches as $match) {
            $tags[] = array(
                'url' => $match[1],
                'end' => $match[1] . "]"
            );
        }
        $this->tags = $tags;
    }

    private function replace($text)
    {
        $parsed = $text;
        foreach ($this->tags as $tag) {
            $parsed = str_replace('[url=', $this->style[0], $parsed);

            if ($this->href) {
                $parsed = str_replace($tag['targetSearch'], $tag['targetReplace'] . $this->style[1], $parsed);
            } else {
                $parsed = str_replace($tag['end'], $tag['url'] . $this->style[1], $parsed);
            }
            $parsed = str_replace('[/url]', '</a>', $parsed);
        }

        return $parsed;
    }
}