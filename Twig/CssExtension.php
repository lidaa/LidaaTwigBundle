<?php

/**
 * This file is part of the LidaaTwigBundle package.
 */

namespace Lidaa\TwigBundle\Twig;

use Symfony\Component\DependencyInjection\ContainerInterface;

/**
 * CssExtension
 *
 * @author Lidaa <aa_dil@hotmail.fr>
 */
class CssExtension extends \Twig_Extension
{
    private $container;

    public function __construct(ContainerInterface $container)
    {
        $this->container = $container;
    }

    public function getFunctions()
    {
        $fonctions = array();

        $fonctions['css_path'] = new \Twig_Function_Method($this, 'cssPath', array('pre_escape' => 'html', 'is_safe' => array('html')));
        $fonctions['css_tag'] = new \Twig_Function_Method($this, 'cssTag', array('pre_escape' => 'html', 'is_safe' => array('html')));

        return $fonctions;
    }

    public function cssPath()
    {
        return '';
    }

    public function cssTag($path, $options = array())
    {
        $packageName = null;
        $src = $this->container->get('templating.helper.assets')->getUrl($path, $packageName);

        if (!key_exists('type', $options))
            $options['type'] = 'text/css';

        $attributes = '';
        foreach ($options as $key => $value) {
            $attributes.= ' ' . $key . '="' . $value . '"';
        }

        return '<link href="' . $src . '"' . $attributes . ' />';
    }

    public function getName()
    {
        return 'css';
    }
}