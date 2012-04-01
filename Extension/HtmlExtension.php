<?php

/**
 * This file is part of the LidaaTwigBundle package.
 */

namespace Lidaa\TwigBundle\Extension;

use Lidaa\TwigBundle\Helper\HelperFactoryInterface;

/**
 * HtmlExtension
 *
 * @author Lidaa <aa_dil@hotmail.fr>
 */
class HtmlExtension extends \Twig_Extension
{
    private $helper;
    
    public function __construct(HelperFactoryInterface $helper)
    {
        $this->helper = $helper('html');
    }
    
    public function getFunctions()
    {
        $fonctions = array();

        $fonctions['html_crumbs'] = new \Twig_Function_Method($this, 'htmlCrumbs', array('pre_escape' => 'html', 'is_safe' => array('html')));
        $fonctions['html_doctype'] = new \Twig_Function_Method($this, 'htmlDocType', array('pre_escape' => 'html', 'is_safe' => array('html')));
        $fonctions['html_charset'] = new \Twig_Function_Method($this, 'htmlCharset', array('pre_escape' => 'html', 'is_safe' => array('html')));
        $fonctions['html_br'] = new \Twig_Function_Method($this, 'htmlBr', array('pre_escape' => 'html', 'is_safe' => array('html')));
        $fonctions['html_nbsp'] = new \Twig_Function_Method($this, 'htmlNbsp', array('pre_escape' => 'html', 'is_safe' => array('html')));
        $fonctions['html_meta'] = new \Twig_Function_Method($this, 'htmlMeta', array('pre_escape' => 'html', 'is_safe' => array('html')));
        $fonctions['html_refresh'] = new \Twig_Function_Method($this, 'htmlRefresh', array('pre_escape' => 'html', 'is_safe' => array('html')));
        $fonctions['html_object'] = new \Twig_Function_Method($this, 'htmlObject', array('is_safe' => array('html')));

        return $fonctions;
    }

    public function htmlCrumbs($path, $variables = array())
    {
        return $this->helper->renderCrumbs($path, $variables);
    }
    
    public function htmlDocType($type = 'html5')
    {
        return $this->helper->docType($type);
    }
    
    public function htmlCharset($charset = 'utf-8')
    {
        return $this->helper->charset($charset);
    }
    
    public function htmlBr($nbr = 1)
    {
        return str_repeat('<br />', $nbr);
    }

    public function htmlNbsp($nbr = 1)
    {
        return str_repeat('&nbsp;', $nbr);
    }

    public function htmlMeta($name, $content, $options = array())
    {
        return $this->helper->renderMeta($name, $content, $options);
    }

    public function htmlRefresh($delay, $url = '')
    {
        return $this->helper->refresh($delay, $url);
    }

    public function htmlObject($uri, $type, $attributes = array(), $params = array(), $content = null)
    {
        return $this->helper->renderObject($uri, $type, $attributes, $params, $content);
    }

    public function getName()
    {
        return 'lidaa.html';
    }

}
