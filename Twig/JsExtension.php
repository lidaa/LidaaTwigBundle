<?php

/**
 * This file is part of the LidaaTwigBundle package.
 */

namespace Lidaa\TwigBundle\Twig;

use Lidaa\TwigBundle\Helper\HelperFactoryInterface;

/**
 * JsExtension
 *
 * @author Lidaa <aa_dil@hotmail.fr>
 */
class JsExtension extends \Twig_Extension
{
    private $helper;
    
    public function __construct(HelperFactoryInterface $helper)
    {
        $this->helper = $helper('js');
    }

    public function getFunctions()
    {
        $fonctions = array();

        $fonctions['js_path'] = new \Twig_Function_Method($this, 'jsPath', array('pre_escape' => 'html', 'is_safe' => array('html')));
        $fonctions['js_tag'] = new \Twig_Function_Method($this, 'jsTag', array('pre_escape' => 'html', 'is_safe' => array('html')));

        return $fonctions;
    }

    public function jsPath()
    {
        return '';
    }

    public function jsTag($path, $options = array())
    {
		return $this->helper->renderJsTag($path, $options);
    }

    public function getName()
    {
        return 'js';
    }
}