<?php

/**
 * This file is part of the LidaaTwigBundle package.
 * 
 * This is the class that loads and manages your bundle configuration
 *
 * To learn more see {@link http://symfony.com/doc/current/cookbook/bundles/extension.html}
 */

namespace Lidaa\TwigBundle\DependencyInjection;

use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\Config\FileLocator;
use Symfony\Component\HttpKernel\DependencyInjection\Extension;
use Symfony\Component\DependencyInjection\Loader;

/**
 * LidaaTwigExtension
 *
 * @author Lidaa <aa_dil@hotmail.fr>
 */
class LidaaTwigExtension extends Extension
{
    /**
     * {@inheritDoc}
     */
    public function load(array $configs, ContainerBuilder $container)
    {
        $configuration = new Configuration();
        $config = $this->processConfiguration($configuration, $configs);

        $loader = new Loader\XmlFileLoader($container, new FileLocator(__DIR__.'/../Resources/config'));
        $loader->load('twig.xml');
        $loader->load('form.xml');
        
        $container->setParameter('lidaa.twig.form.resources', $config['form']['resources']);
    }
}
