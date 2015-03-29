<?php

namespace Forti\Bundle\BbcodeBundle\Parser;

use Forti\Bundle\BbcodeBundle\Parser\AbstractParser;

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
