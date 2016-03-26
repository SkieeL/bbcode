<?php

namespace Forti\bbcode\Twig;

use Forti\bbcode\Parser\Parser;

class BbCodeExtension extends \Twig_Extension
{
    protected $config = [];

    public function __construct(array $config)
    {
        $this->config = $config;
    }

    public function getFilters()
    {
        return array(
            new \Twig_SimpleFilter('bbcode', array($this, 'bbCodeParser'), array('is_safe' => array('html'))),
        );
    }

    public function bbCodeParser($text)
    {
        $parser = new Parser($this->config);
        return $parser->parse($text);
    }

    public function getName()
    {
        return 'bbcode_bbcode_extension';
    }
}