<?php

namespace AppBundle\Twig;


use AppBundle\Utils\MarkdownHelper;

class TextExtension extends \Twig_Extension
{
    private $parser;

    public function __construct(MarkdownHelper $parser)
    {
        $this->parser = $parser;
    }

    public function getFilters()
    {
        return [
            'md2html' => new \Twig_Filter_Method($this, 'markdownToHtml'),
        ];
    }

    public function markdownToHtml($content)
    {
        return $this->parser->toHtml($content);
    }

    public function getName()
    {
        return 'text_extension';
    }
}