<?php

/**
 * This file is part of the LidaaTwigBundle package.
 */

namespace Lidaa\TwigBundle\Helper;

use Symfony\Component\Templating\Helper\HelperInterface;


/**
 * JsHelper
 *
 * @author Lidaa <aa_dil@hotmail.fr>
 */
class JsHelper
{

    private $assets;

    public function __construct(HelperInterface $assets)
    {	
        $this->assets = $assets;
    }

    public function renderJsTag($path, $options)
    {
        $packageName = null;
        $src = $this->assets->getUrl($path, $packageName);

        if (!key_exists('type', $options))
            $options['type'] = 'text/javascript';

        $attributes = '';
        foreach ($options as $key => $value) {
            $attributes.= ' ' . $key . '="' . $value . '"';
        }

        return '<script src="' . $src . '"' . $attributes . ' ></script>';
    }

}
