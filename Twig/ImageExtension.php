<?php

/**
 * This file is part of the LidaaTwigBundle package.
 */

namespace Lidaa\TwigBundle\Twig;

use Lidaa\TwigBundle\Helper\HelperFactoryInterface;

/**
 * ImageExtension
 *
 * @author Lidaa <aa_dil@hotmail.fr>
 */
class ImageExtension extends \Twig_Extension
{
    private $helper;
    
    public function __construct(HelperFactoryInterface $helper)
    {
        $this->helper = $helper('image');
    }

    public function getFunctions()
    {
        $fonctions = array();

        $fonctions['img_path'] = new \Twig_Function_Method($this, 'imgPath', array('pre_escape' => 'html', 'is_safe' => array('html')));
        $fonctions['img_tag'] = new \Twig_Function_Method($this, 'imgTag', array('pre_escape' => 'html', 'is_safe' => array('html')));

        return $fonctions;
    }

    public function imgPath()
    {
        return '';
    }

    public function imgTag($path, $options = array())
    {
        return $this->helper->renderImgTag($path, $options);
    }

    public function getName()
    {
        return 'image';
    }
}