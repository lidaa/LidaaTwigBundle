<?php

/**
 * This file is part of the LidaaTwigBundle package.
 */

namespace Lidaa\TwigBundle\Helper;

use Symfony\Component\Templating\Helper\HelperInterface;


/**
 * CssHelper
 *
 * @author Lidaa <aa_dil@hotmail.fr>
 */
class CssHelper
{

    private $assets;

    public function __construct(HelperInterface $assets)
    {	
        $this->assets = $assets;
    }

    public function renderCssTag($path, $options)
    {
    	 $packageName = null;
    	 $src = $this->assets->getUrl($path, $packageName);
    	
    	 if (!key_exists('type', $options))
    	 	$options['type'] = 'text/css';
    	
    	 $attributes = '';
    	 foreach ($options as $key => $value) {
    	 	$attributes.= ' ' . $key . '="' . $value . '"';
    	 }
    	
    	 return '<link href="' . $src . '"' . $attributes . ' />';
    }

}
