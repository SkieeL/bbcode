<?php

namespace Forti\Bundle\BbcodeBundle\Parser;

abstract class AbstractParser
{
    protected $tags = array(
        '[b]',
        '[i]',
        '[u]',
    );

    protected $found = array();
    protected $parsed = false;

    public function __construct()
    {

    }
}