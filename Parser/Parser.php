<?php

namespace Forti\bbcode\Parser;

use Forti\bbcode\Parser\AbstractParser;

class Parser extends AbstractParser
{
    public function __construct()
    {
        parent::__construct();
    }

    public function parse($text)
    {
        return $this->single($text);
    }
}
