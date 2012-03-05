<?php

/**
 * This file is part of the LidaaTwigBundle package.
 */

namespace Lidaa\TwigBundle\Helper;

use Symfony\Component\Routing\Generator\UrlGeneratorInterface;


/**
 * UrlHelper
 *
 * @author Lidaa <aa_dil@hotmail.fr>
 */
class UrlHelper
{
    private $generator;

    public function __construct(UrlGeneratorInterface $generator)
    {	
        $this->generator = $generator;
    }

    public function renderLinkTo($title, $name, $parameters, $options)
    {
    	$url = $this->generator->generate($name, $parameters);
    	
    	$attributes = '';
    	foreach ($options as $key => $value) {
    		$attributes.= ' ' . $key . '="' . $value . '"';
    	}
    	
    	return '<a href="' . $url . '"' . $attributes . '>' . $title . '</a>';
    }
    
    public function renderLinkToggle($type, $condition, $title, $options)
    {
        if ((!$condition && $type == 'if') || ($condition && $type == 'unless'))
            return '';

        if (!key_exists('href', $options))
            $options['href'] = '#';

        $attributes = '';
        foreach ($options as $key => $value) {
            $attributes.= ' ' . $key . '="' . $value . '"';
        }

        return '<a' . $attributes . '>' . $title . '</a>';
    }

}
