<?php

namespace Forti\bbcode\Parser\Tags;

class TagFactory
{
    protected $config = [];

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
        ),
        'youtube' => array(
            'open' => '[youtube',
            'class' => 'TagYouTube',
            'close' => '[/youtube]'
        ),
        'quote' => array(
            'open' => '[blockquote',
            'class' => 'TagBlockQuote',
            'close' => '[/blockquote]'
        ),
        'image' => array(
            'open' => '[img',
            'class' => 'TagImage',
            'close' => '[/img]'
        ),
        'pre' => [
            'open' => '[pre',
            'class' => 'TagPre',
            'close' => '[/pre]'
        ]
    );

    public function __construct($text, array $config = [])
    {
        $this->text = $text;
        $this->config = $config;
    }

    public function parse()
    {
        foreach ($this->tags as $key => $tag) {
            if (strpos($this->text, $tag['open']) !== false) {
                $class = $tag['class'];
                $className = __NAMESPACE__ . "\\{$class}";

                $config = isset($this->config[$key]) ? $this->config[$key] : [];

                /** @var TagInterface $class */
                $class = new $className($config);
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