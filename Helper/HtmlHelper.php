<?php

/**
 * This file is part of the LidaaTwigBundle package.
 */

namespace Lidaa\TwigBundle\Helper;

use Symfony\Component\HttpKernel\KernelInterface;
use Symfony\Component\Translation\TranslatorInterface;
use Symfony\Component\Routing\RouterInterface;
use Lidaa\TwigBundle\Crumbs\Crumbs;

/**
 * HtmlHelper
 *
 * @author Lidaa <aa_dil@hotmail.fr>
 */
class HtmlHelper
{

    private $kernel;
    private $translator;
    private $router;
    private $docTypes = array(
        'html4-strict' => '<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01//EN" "http://www.w3.org/TR/html4/strict.dtd">',
        'html4-trans' => '<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">',
        'html4-frame' => '<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Frameset//EN" "http://www.w3.org/TR/html4/frameset.dtd">',
        'html5' => '<!DOCTYPE html>',
        'xhtml-strict' => '<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">',
        'xhtml-trans' => '<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">',
        'xhtml-frame' => '<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Frameset//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-frameset.dtd">',
        'xhtml11' => '<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.1//EN" "http://www.w3.org/TR/xhtml11/DTD/xhtml11.dtd">'
    );

    public function __construct(KernelInterface $kernel, TranslatorInterface $translator, RouterInterface $router)
    {
        $this->kernel = $kernel;
        $this->translator = $translator;
        $this->router = $router;
    }

    public function renderCrumbs($path, $variables)
    {
        if (2 != substr_count($path, ':')) {
             throw new \InvalidArgumentException("Invalid path '$path'. Expected 'bundle:class:method'");            
        }

        list($bundleName, $className, $methodName) = explode(':', $path);

        $crumbs = $this->getCrumbs($bundleName, $className, $methodName, $variables);

        $html_crumbs = '<ul class="crumbs">';
        foreach ($crumbs as $crumb) {

            $html_crumbs .= $this->renderCrumb($crumb);

            if (!$crumbs->isLast()) {
                $html_crumbs .= $crumbs->getSeparator();
            }
        }
        $html_crumbs .= '</ul>';

        return $html_crumbs;
    }

    public function docType($type)
    {
        if (isset($this->docTypes[$type])) {
            return $this->docTypes[$type];
        }
        return null;
    }

    public function charset($charset)
    {
        $tag = sprintf('<meta http-equiv="Content-Type" content="text/html; charset=%s" />', $charset);
        return $tag;
    }

    public function refresh($delay, $url) 
    {
        $tag = sprintf('<meta http-equiv="Refresh" content="%d; %s" />', $delay, $url);
        
        return $tag;
    }

    public function renderMeta($name, $content, $options) 
    {   
        $attributes = '';
        foreach ($options as $key => $value) {
            $attributes.= $key . '="' . $value . '" ';
        }

        $tag = sprintf('<meta name="%s" content="%s" %s/>', $name, $content, $attributes);
        
        return $tag;
    }

    public function renderObject($uri, $type, $options, $params, $content)
    {
        $attributes = '';
        foreach ($options as $key => $value) {
            $attributes.= $key . '="' . $value . '" ';
        }

        $tags_params = '';
        foreach ($params as $key => $value) {
            $tags_params.= '<param name="' . $key . '" value="' . $value . '" />';
        }
        
        if(!$tags_params && !$content) {
            $tag = sprintf('<object data="%s" type="%s" %s/>', $uri, $type, $attributes);
        
            return $tag;
        }
        
        $tag = sprintf('<object data="%s" type="%s" %s> %s %s </object>', $uri, $type, $attributes, $tags_params, $content);

        return $tag;
    }

    protected function renderCrumb($crumb)
    {
        $title = $this->translator->trans($crumb[0]);

        if (isset($crumb[2]['route']) && $crumb[2]['route'] == false) {
            $href = $crumb[1];
        } else {
            $href = $this->router->generate($crumb[1], $crumb[2]);
        }


        $html_crumb = sprintf('<li><a href="%s">%s</a></li>', $href, $title);

        return $html_crumb;
    }

    protected function getCrumbs($bundleName, $className, $methodName, $variables)
    {

        $builder = $this->getBuilder($bundleName, $className);

        if (!method_exists($builder, $methodName)) {
            throw new \InvalidArgumentException(sprintf('Method "%s" was not found on class "%s"', $methodName, $className));
        }

        $crumbs = $builder->$methodName(new Crumbs(), $variables);

        return $crumbs;
    }

    protected function getBuilder($bundleName, $className)
    {

        $bundle = $this->kernel->getBundle($bundleName);

        $class = $bundle->getNamespace() . '\\Crumbs\\' . $className;

        if (!class_exists($class)) {
            throw new \InvalidArgumentException(sprintf('Class "%s" does not exist', $class));
        }

        $builder = new $class();

        return $builder;
    }

}

