<?php

namespace Forti\Bundle\BbcodeBundle\Parser\Tags;

class TagFactory
{
    private $text = false;
    private $tags = array(
        '[b]',
        '[i]',
        '[u]',
        '[color'
    );

    public function __construct($text)
    {
        $this->text = $text;
    }

    public function parse()
    {
        foreach ($this->tags as $tag) {
            if (strpos($this->text, $tag)) {

                $tag = str_replace(array('[', ']'), '', $tag);
                $tag = ucfirst($tag);
                $className = __NAMESPACE__ . "\\Tag{$tag}";

                $class = new $className();
                $class->parse($this->text);
                $this->text = $class->getParsed();

            }
        }
    }

    public function getParsed()
    {
        return $this->text;
    }
}