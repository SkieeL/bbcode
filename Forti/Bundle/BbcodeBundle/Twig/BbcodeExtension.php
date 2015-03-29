<?php

namespace Forti\Bundle\BbcodeBundle\Twig;

use Forti\Bundle\BbcodeBundle\Parser\Parser;

class BbCodeExtension extends \Twig_Extension
{
    public function getFilters()
    {
        return array(
            new \Twig_SimpleFilter('bbcode', array($this, 'bbCodeParser'), array('is_safe' => array('html'))),
        );
    }

    public function bbCodeParser($text)
    {
        $parser = new Parser();
        return $parser->parse($text);
    }

    public function getName()
    {
        return 'bbcode_bbcode_extension';
    }
}