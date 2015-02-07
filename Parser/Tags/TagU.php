<?php

namespace Forti\Bundle\BbcodeBundle\Parser\Tags;

use Forti\Bundle\BbcodeBundle\Parser\Tags\TagInterface;

class TagU implements TagInterface
{

    private $parsed = false;
    private $tag = array(
        '<span style="text-decoration: underline">',
        '</span>'
    );

    public function __construct()
    {

    }

    public function parse($text)
    {
        $parsed = str_replace(array("[u]", "[/u]"), $this->tag, $text);
        $this->parsed = $parsed;
    }

    public function getParsed()
    {
        return $this->parsed;
    }
}