<?php

/**
 * This file is part of the LidaaTwigBundle package.
 */

namespace Lidaa\TwigBundle\Extension;

use Lidaa\TwigBundle\Helper\HelperFactoryInterface;

/**
 * UrlExtension
 *
 * @author Lidaa <aa_dil@hotmail.fr>
 */
class UrlExtension extends \Twig_Extension
{
    private $helper;
    
    public function __construct(HelperFactoryInterface $helper)
    {
    	$this->helper = $helper('url');
    }
    
    public function getFunctions()
    {
        $fonctions = array();
        $fonctions['link_to'] = new \Twig_Function_Method($this, 'linkTo', array('is_safe' => array('html')));
        $fonctions['link_to_if'] = new \Twig_Function_Method($this, 'linkToIf', array('is_safe' => array('html')));
        $fonctions['link_to_unless'] = new \Twig_Function_Method($this, 'linkToUnless', array('is_safe' => array('html')));

        return $fonctions;
    }

    public function linkTo($title, $name, $parameters = array(), $options = array())
    {
        return $this->helper->renderLinkTo($title, $name, $parameters, $options);
    }

    public function linkToIf($condition, $title, $options = array())
    {
        return $this->helper->renderLinkToggle('if', $condition, $title, $options);
    }

    public function linkToUnless($condition, $title, $options = array())
    {
    	return $this->helper->renderLinkToggle('unless', $condition, $title, $options);    	
    }

    public function getName()
    {
        return 'url';
    }
}