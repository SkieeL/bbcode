<?php

namespace Forti\bbcode\Parser\Tags;

interface TagInterface
{
    public function __construct();
    public function parse($text);
    public function getParsed();
}