<?php

/**
 * This file is part of the LidaaTwigBundle package.
 */

namespace Lidaa\TwigBundle\Helper;

use Symfony\Component\Templating\Helper\HelperInterface;


/**
 * ImageHelper
 *
 * @author Lidaa <aa_dil@hotmail.fr>
 */
class ImageHelper
{

    private $assets;

    public function __construct(HelperInterface $assets)
    {	
        $this->assets = $assets;
    }

    public function renderImgTag($path, $options)
    {
        $packageName = null;
        $src = $this->assets->getUrl($path, $packageName);

        $attributes = '';
        foreach ($options as $key => $value) {
            $attributes.= ' ' . $key . '="' . $value . '"';
        }

        return '<img src="' . $src . '"' . $attributes . ' />';
    }

}
