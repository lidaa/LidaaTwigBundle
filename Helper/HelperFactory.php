<?php

/**
 * This file is part of the LidaaTwigBundle package.
 */

namespace Lidaa\TwigBundle\Helper;

use Symfony\Component\DependencyInjection\ContainerInterface;

/**
 * HelperFactory
 *
 * @author Lidaa <aa_dil@hotmail.fr>
 */
class HelperFactory implements HelperFactoryInterface
{

    private $container;

    public function __construct(ContainerInterface $container)
    {
        $this->container = $container;
    }

    public function getHelper($class_name)
    {
    	$class = __NAMESPACE__.'\\'.$class_name;
    	
        switch ($class_name) {
            case 'HtmlHelper':
                return new $class($this->container->get('kernel'), $this->container->get('translator'), $this->container->get('router'));
            
            case 'CssHelper':
			case 'ImageHelper':
			case 'JsHelper':				
               	return new $class($this->container->get('templating.helper.assets'));
               	
			case 'UrlHelper':
            	return new $class($this->container->get('router'));
        }
    }

    public function __invoke($name)
    {
        $class_name = sprintf("%sHelper", ucfirst($name));

        return $this->getHelper($class_name);
    }

}

