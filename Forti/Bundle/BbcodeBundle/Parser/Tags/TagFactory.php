<?php

namespace Forti\Bundle\BbcodeBundle\Parser\Tags;

class TagFactory
{
    private $text = false;
    private $tags = array(
        'bold' => array(
            'open' => '[b]',
            'class' => 'TagBold',
            'close' => '[/b]'
        ),
        'italic' => array(
            'open' => '[i]',
            'class' => 'TagItalic',
            'close' => '[/i]'
        ),
        'underline' => array(
            'open' => '[u]',
            'class' => 'TagUnderline',
            'close' => '[/u]'
        ),
        'color' => array(
            'open' => '[color',
            'class' => 'TagColor',
            'close' => '[/color]'
        ),
        'url' => array(
            'open' => '[url',
            'class' => 'TagUrl',
            'close' => '[/url]'
        )
    );

    public function __construct($text)
    {
        $this->text = $text;
    }

    public function parse()
    {
        foreach ($this->tags as $tag) {
            if (strpos($this->text, $tag['open']) !== false) {

                $className = __NAMESPACE__ . "\\{$tag['class']}";

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