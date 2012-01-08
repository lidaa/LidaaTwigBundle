<?php

namespace Lidaa\TwigBundle\Twig;

use Symfony\Component\DependencyInjection\ContainerInterface;

class JsExtension extends \Twig_Extension {

    private $container;

    public function __construct(ContainerInterface $container)
    {
        $this->container = $container;
    }

    public function getFunctions() {
        $fonctions = array();

        $fonctions['js_path'] = new \Twig_Function_Method($this, 'jsPath', array('pre_escape' => 'html', 'is_safe' => array('html')));
        $fonctions['js_tag'] = new \Twig_Function_Method($this, 'jsTag', array('pre_escape' => 'html', 'is_safe' => array('html')));

        return $fonctions;
    }

    public function jsPath() {

        return '';
    }

    public function jsTag($path, $options = array()) {
        
        $packageName = null;
        $src = $this->container->get('templating.helper.assets')->getUrl($path, $packageName);

        
        if(!key_exists('type', $options))
            $options['type'] = 'text/javascript';
        
        $attributes = '';
        foreach ($options as $key => $value) {
            $attributes.= ' ' . $key . '="' . $value . '"';
        }

        return '<script src="'. $src .'"'. $attributes . ' ></script>';
    }

    public function getName() {
        return 'js';
    }

}