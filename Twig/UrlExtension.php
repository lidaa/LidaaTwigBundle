<?php

namespace Lidaa\TwigBundle\Twig;

use Symfony\Component\Routing\Generator\UrlGeneratorInterface;

class UrlExtension extends \Twig_Extension {

    private $generator;

    public function __construct(UrlGeneratorInterface $generator) {
        $this->generator = $generator;
    }

    public function getFunctions() {
        $fonctions = array();
        $fonctions['link_to'] = new \Twig_Function_Method($this, 'linkTo', array('is_safe' => array('html')));
        $fonctions['link_to_if'] = new \Twig_Function_Method($this, 'linkToIf', array('is_safe' => array('html')));
        $fonctions['link_to_unless'] = new \Twig_Function_Method($this, 'linkToUnless', array('is_safe' => array('html')));

        return $fonctions;
    }

    public function linkTo($title, $name, $parameters = array(), $options = array()) {
        
        $url = $this->generator->generate($name, $parameters);
        
        $attributes = '';
        foreach ($options as $key => $value) {
            $attributes.= ' ' . $key . '="' . $value . '"';
        }
        
        return '<a href="'. $url .'"'. $attributes . '>'.$title.'</a>';
    }

    public function linkToIf($condition, $title, $options = array()) {
        
        if(!$condition) return '';
        
        if(!key_exists('href', $options))
            $options['href'] = '#';

        $attributes = '';
        foreach ($options as $key => $value) {
            $attributes.= ' ' . $key . '="' . $value . '"';
        }
        
        return '<a'. $attributes . '>'.$title.'</a>';
    }
    
    public function linkToUnless($condition, $title, $options = array()) {
        
        if($condition) return '';
        
        
        if(!key_exists('href', $options))
            $options['href'] = '#';

        $attributes = '';
        foreach ($options as $key => $value) {
            $attributes.= ' ' . $key . '="' . $value . '"';
        }
        
        return '<a'. $attributes . '>'.$title.'</a>';
    }
    
    public function getName() {
        return 'url';
    }


}
