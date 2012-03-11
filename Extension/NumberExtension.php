<?php

/**
 * This file is part of the LidaaTwigBundle package.
 */

namespace Lidaa\TwigBundle\Extension;

use Lidaa\TwigBundle\Helper\HelperFactoryInterface;

/**
 * NumberExtension
 *
 * @author Lidaa <aa_dil@hotmail.fr>
 */
class NumberExtension extends \Twig_Extension
{
    private $helper;
    
    public function __construct(HelperFactoryInterface $helper)
    {
        $this->helper = $helper('number');
    }
	
    public function getFunctions()
    {
        $fonctions = array();

        $fonctions['to_percent'] = new \Twig_Function_Method($this, 'toPercent');
        $fonctions['to_readable_size'] = new \Twig_Function_Method($this, 'toReadableSize');
        $fonctions['number_currency'] = new \Twig_Function_Method($this, 'NumberCurrency');
        $fonctions['number_scientific'] = new \Twig_Function_Method($this, 'NumberScientific');
        $fonctions['localized_number'] = new \Twig_Function_Method($this, 'localizedNumber');
        $fonctions['localized_spellout'] = new \Twig_Function_Method($this, 'localizedSpellout');

        return $fonctions;
    }

    public function localizedSpellout($number, $locale = null) 
    {
    	return $this->helper->localizedSpellout($number, $locale);    	
    }
    
    public function localizedNumber($number, $locale = null)
    {
    	return $this->helper->localizedNumber($number, $locale);
    }
    
    public function NumberCurrency($number, $symbol = 'EUR', $locale = null) 
    {
    	return $this->helper->NumberCurrency($number, $symbol, $locale);    	
    }
    
    public function NumberScientific($number, $locale = null) 
    {
    	return $this->helper->NumberScientific($number, $locale);    	
    }

    public function toPercent($number)
    {
    	return $this->helper->toPercent($number);
    }

    public function toReadableSize($number)
    {
        return $this->helper->toReadableSize($number);
    }

    public function getName()
    {
        return 'lidaa.number';
    }
}
