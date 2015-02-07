<?php

namespace Forti\Bundle\BbcodeBundle\Parser\Tags;

interface TagInterface
{
    public function __construct($text);
    public function getParsed();
}