<?php

/**
* This file is part of the LidaaTwigBundle package.
*/

namespace Lidaa\TwigBundle\Tests;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;
use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\DependencyInjection\ParameterBag\ParameterBag;
use Lidaa\TwigBundle\DependencyInjection\LidaaTwigExtension as TwigExtension;

/**
* ExtensionTest
*
* @author Lidaa <aa_dil@hotmail.fr>
*/
class ExtensionTest extends WebTestCase
{    
    public function testLoadEmptyConfiguration()
    {
    	$container = $this->createContainer();
    	$container->registerExtension(new TwigExtension());
    	$container->loadFromExtension('lidaa_twig', array());
    	$this->compileContainer($container);
    	
    	$this->assertContains('LidaaTwigBundle:Form:form_layout.html.twig', $container->getParameter('lidaa.twig.form.resources'));
    	
    	$this->assertEquals('Lidaa\TwigBundle\Extension\UrlExtension', $container->getParameter('lidaa.twig.extension.url.class'));
    	$this->assertEquals('Lidaa\TwigBundle\Extension\PhpExtension', $container->getParameter('lidaa.twig.extension.php.class'));
    	$this->assertEquals('Lidaa\TwigBundle\Extension\ImageExtension', $container->getParameter('lidaa.twig.extension.image.class'));
    	$this->assertEquals('Lidaa\TwigBundle\Extension\TagExtension', $container->getParameter('lidaa.twig.extension.tag.class'));
    	$this->assertEquals('Lidaa\TwigBundle\Extension\CssExtension', $container->getParameter('lidaa.twig.extension.css.class'));
    	$this->assertEquals('Lidaa\TwigBundle\Extension\JsExtension', $container->getParameter('lidaa.twig.extension.js.class'));
    	$this->assertEquals('Lidaa\TwigBundle\Extension\SessionExtension', $container->getParameter('lidaa.twig.extension.session.class'));
    	$this->assertEquals('Lidaa\TwigBundle\Extension\NumberExtension', $container->getParameter('lidaa.twig.extension.number.class'));
    	$this->assertEquals('Lidaa\TwigBundle\Extension\SfExtension', $container->getParameter('lidaa.twig.extension.sf.class'));
    	$this->assertEquals('Lidaa\TwigBundle\Extension\FormExtension', $container->getParameter('lidaa.twig.extension.form.class'));
    	$this->assertEquals('Lidaa\TwigBundle\Extension\UnsetExtension', $container->getParameter('lidaa.twig.extension.unset.class'));
    	$this->assertEquals('Lidaa\TwigBundle\Extension\HtmlExtension', $container->getParameter('lidaa.twig.extension.html.class'));
    	$this->assertEquals('Lidaa\TwigBundle\Helper\HelperFactory', $container->getParameter('lidaa.twig.helperfactory.class'));
    	$this->assertEquals('Lidaa\TwigBundle\Form\Type\FieldType', $container->getParameter('lidaa.form.type.field.class'));
    	 
    }
    
    private function createContainer()
    {
    	$container = new ContainerBuilder(new ParameterBag(array(
                'kernel.cache_dir' => __DIR__,
                'kernel.charset'   => 'UTF-8',
                'kernel.debug'     => false,
    	)));
    
    	return $container;
    }
    
    private function compileContainer(ContainerBuilder $container)
    {
    	$container->getCompilerPassConfig()->setOptimizationPasses(array());
    	$container->getCompilerPassConfig()->setRemovingPasses(array());
    	$container->compile();
    }
}
