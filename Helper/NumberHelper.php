<?php

/**
 * This file is part of the LidaaTwigBundle package.
 */

namespace Lidaa\TwigBundle\Helper;

use Symfony\Component\Locale\Stub\StubNumberFormatter;

/**
 * NumberHelper
 *
 * @author Lidaa <aa_dil@hotmail.fr>
 */
class NumberHelper
{
    public function localizedNumber($number, $locale)
    {    	
    	$number_formatter = $this->getNumberFormatter($locale, 'DECIMAL');
    	
    	return $number_formatter->format($number);
    }

    public function NumberCurrency($number, $symbol, $locale)
    {
    	$number_formatter = $this->getNumberFormatter($locale, 'CURRENCY');
    	
    	if(!$symbol) 
    		$symbol = $number_formatter->getSymbol(\NumberFormatter::INTL_CURRENCY_SYMBOL);
    	
    	return $number_formatter->formatCurrency($number, $symbol);
    }

    public function NumberScientific($number, $locale)
    {
    	$number_formatter = $this->getNumberFormatter($locale, 'SCIENTIFIC');
    	 
    	return $number_formatter->format($number);
    }
    
    public function localizedSpellout($number, $locale)
    {
    	$number_formatter = $this->getNumberFormatter($locale, 'SPELLOUT');
    	 
    	return $number_formatter->format($number);
    }
    
    public function toPercent($number) 
    {	
    	$number_formatter = $this->getNumberFormatter($locale = null, 'PERCENT');
    	
    	return $number_formatter->format($number);
    }
    
    public function toReadableSize($number) 
    {
	    $units = array('B','KB','MB','GB','TB');
	    
	    for($i=0; $number >= 1024; $i++) {
	    	$number /= 1024;
	    }
	    
	    return round($number,2).' '.$units[$i];
    }

    protected function getNumberFormatter($locale, $style) 
    {
    	$numberFormatterClass = new \ReflectionClass('\NumberFormatter');
    	
    	return \NumberFormatter::create($locale, $numberFormatterClass->getConstant($style));
    }
}
