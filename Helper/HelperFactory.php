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

    public function getHelper($class)
    {
    	$object = __NAMESPACE__.'\\'.$class;
    	
        switch ($class) {
            case 'HtmlHelper':
                return new $object($this->container->get('kernel'), $this->container->get('translator'), $this->container->get('router'));
            
            case 'CssHelper':
			case 'ImageHelper':
			case 'JsHelper':				
               	return new $object($this->container->get('templating.helper.assets'));
               	
			case 'UrlHelper':
            	return new $object($this->container->get('router'));
        }
    }

    public function __invoke($name)
    {
        $class = sprintf("%sHelper", ucfirst($name));

        return $this->getHelper($class);
    }

}
