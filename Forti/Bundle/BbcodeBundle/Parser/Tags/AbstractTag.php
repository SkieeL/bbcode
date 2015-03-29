<?php

namespace Forti\Bundle\BbcodeBundle\Parser\Tags;

abstract class AbstractTag
{
    protected function validate(array $tags, $text)
    {
        $result = '';
        foreach ($tags as $tag) {
            if (is_array($tag)) {
                $result = $this->validate($tag, $text);
            } else {
                $result = $this->search($text, $tag);
            }
        }
        return $result;
    }

    private function search($text, $tag)
    {
        return strpos($text, $tag) ? true : false;
    }
}