<?php

namespace Lidaa\TwigBundle\Twig;

use Symfony\Component\DependencyInjection\ContainerInterface;

class ImageExtension extends \Twig_Extension {

    private $container;

    public function __construct(ContainerInterface $container)
    {
        $this->container = $container;
    }

    public function getFunctions() {
        $fonctions = array();

        $fonctions['img_path'] = new \Twig_Function_Method($this, 'imgPath', array('pre_escape' => 'html', 'is_safe' => array('html')));
        $fonctions['img_tag'] = new \Twig_Function_Method($this, 'imgTag', array('pre_escape' => 'html', 'is_safe' => array('html')));

        return $fonctions;
    }

    public function imgPath() {

        return '';
    }

    public function imgTag($path, $options = array()) {
        
        $packageName = null;
        $src = $this->container->get('templating.helper.assets')->getUrl($path, $packageName);

        $attributes = '';
        foreach ($options as $key => $value) {
            $attributes.= ' ' . $key . '="' . $value . '"';
        }

        return '<img src="'. $src .'"'. $attributes . ' />';
    }

    public function getName() {
        return 'image';
    }

}
