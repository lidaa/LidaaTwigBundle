<?php

/**
 * This file is part of the LidaaTwigBundle package.
 */

namespace Lidaa\TwigBundle\Extension;

use Lidaa\TwigBundle\Helper\HelperFactoryInterface;

/**
 * TextExtension
 *
 * @author Lidaa <aa_dil@hotmail.fr>
 */
class TextExtension extends \Twig_Extension
{
    private $helper;
    
    public function __construct(HelperFactoryInterface $helper)
    {
        $this->helper = $helper('text');
    }
	
    public function getFunctions()
    {
        $fonctions = array();

        $fonctions['highlight'] = new \Twig_Function_Method($this, 'highlight', array('is_safe' => array('html')));
        $fonctions['ellipsize'] = new \Twig_Function_Method($this, 'ellipsize', array('is_safe' => array('html')));
        
        return $fonctions;
    }

    public function highlight($haystack, $string, $color = "#990000", $tag = 'span') 
    {
    	return $this->helper->highlight($haystack, $string, $color, $tag);    	
    }

    public function ellipsize($str, $max_length, $position = 1, $ellipsis = '&hellip;') 
    {
    	return $this->helper->ellipsize($str, $max_length, $position, $ellipsis);    	
    }
    
    public function getName()
    {
        return 'lidaa.text';
    }
}

