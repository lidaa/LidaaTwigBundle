<?php

/**
 * This file is part of the LidaaTwigBundle package.
 */

namespace Lidaa\TwigBundle\Twig;

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

    public function getName()
    {
        return 'lidaa.html';
    }

}