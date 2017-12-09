<?php

namespace AppBundle\Template;


use Pagerfanta\View\Template\DefaultTemplate;

class ComebackTemplate extends DefaultTemplate
{
    static protected $defaultOptions = array(
        'previous_message'   => '<i class="fa fa-angle-left"></i>Précédent',
        'next_message'       => 'Suivant <i class="fa fa-angle-right"></i>',
        'css_disabled_class' => 'disabled',
        'css_dots_class'     => 'dots',
        'css_current_class'  => 'current',
        'dots_text'          => '...',
        'container_template' => '<div class="pagination">%pages%</div>',
        'page_template'      => '<a href="%href%"%rel%>%text%</a>',
        'span_template'      => '<span class="%class%">%text%</span>',
        'rel_previous'        => 'prev',
        'rel_next'            => 'next',
        'css_prev_class'      => 'prev',
        'css_next_class'      => 'next',
    );

    public function previousEnabled($page)
    {
        $text = $this->option('previous_message');
        $class = $this->option('css_prev_class');

        return $this->pageWithTextAndClass($page, $text, $class);
    }

    public function nextEnabled($page)
    {
        $text = $this->option('next_message');
        $class = $this->option('css_next_class');

        return $this->pageWithTextAndClass($page, $text, $class);
    }

    private function pageWithTextAndClass($page, $text, $class)
    {
        $href = $this->generateRoute($page);

        return $this->link($class, $href, $text);
    }

    private function link($class, $href, $text)
    {
        return sprintf('<a class="%s %s" href="%s">%s</a>', null, $class, $href, $text);
    }
}