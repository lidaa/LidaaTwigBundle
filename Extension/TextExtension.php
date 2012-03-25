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
        
        return $fonctions;
    }
    
    public function getName()
    {
        return 'lidaa.text';
    }
}
