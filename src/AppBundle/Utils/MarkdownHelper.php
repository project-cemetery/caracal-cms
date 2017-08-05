<?php

namespace AppBundle\Utils;


class MarkdownHelper
{
    private $parser;

    public function __construct()
    {
        $this->parser = new \Parsedown();
    }

    public function toHtml($text)
    {
        $html = $this->parser->text($text);
        $html = str_replace('<ul>', '<ul class="default">', $html);

        return $html;
    }
}