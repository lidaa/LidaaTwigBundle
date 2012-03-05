<?php

/**
 * This file is part of the LidaaTwigBundle package.
 */

namespace Lidaa\TwigBundle\Twig;

/**
 * TagExtension
 *
 * @author Lidaa <aa_dil@hotmail.fr>
 */
class TagExtension extends \Twig_Extension
{
    public function getFunctions()
    {
        $fonctions = array();

        $fonctions['tag_open'] = new \Twig_Function_Method($this, 'tagOpen', array('pre_escape' => 'html', 'is_safe' => array('html')));
        $fonctions['tag_close'] = new \Twig_Function_Method($this, 'tagClose', array('pre_escape' => 'html', 'is_safe' => array('html')));
        $fonctions['tag_content'] = new \Twig_Function_Method($this, 'tagContent', array('pre_escape' => 'html', 'is_safe' => array('html')));

        return $fonctions;
    }

    public function tagOpen($name, $options = array(), $close = false)
    {
        if (!$name)
            return '';

        $attributes = '';
        foreach ($options as $key => $value) {
            $attributes.= ' ' . $key . '="' . $value . '"';
        }

        $tag = '<' . $name . $attributes . ($close ? ' />' : '>');

        return $tag;
    }

    public function tagClose($name)
    {
        $tag = '</' . $name . '>';
        return $tag;
    }

    public function tagContent($name, $content, $options=array())
    {
        $open = $this->tagOpen($name, $options, false);
        $close = $this->tagClose($name);

        $tag = $open . $content . $close;

        return $tag;
    }

    public function getName()
    {
        return 'tag';
    }
}