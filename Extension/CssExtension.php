<?php

/**
 * This file is part of the LidaaTwigBundle package.
 */

namespace Lidaa\TwigBundle\Extension;

use Lidaa\TwigBundle\Helper\HelperFactoryInterface;

/**
 * CssExtension
 *
 * @author Lidaa <aa_dil@hotmail.fr>
 */
class CssExtension extends \Twig_Extension
{
    private $helper;
    
    public function __construct(HelperFactoryInterface $helper)
    {
        $this->helper = $helper('css');
    }

    public function getFunctions()
    {
        $fonctions = array();

        $fonctions['css_path'] = new \Twig_Function_Method($this, 'cssPath', array('pre_escape' => 'html', 'is_safe' => array('html')));
        $fonctions['css_tag'] = new \Twig_Function_Method($this, 'cssTag', array('pre_escape' => 'html', 'is_safe' => array('html')));

        return $fonctions;
    }

    public function cssPath()
    {
        return '';
    }

    public function cssTag($path, $options = array())
    {
		return $this->helper->renderCssTag($path, $options);
    }

    public function getName()
    {
        return 'css';
    }
}