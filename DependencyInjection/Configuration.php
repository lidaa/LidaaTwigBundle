<?php

/**
 * This file is part of the LidaaTwigBundle package.
 * 
 * This is the class that validates and merges configuration from your app/config files
 *
 * To learn more see {@link http://symfony.com/doc/current/cookbook/bundles/extension.html#cookbook-bundles-extension-config-class}
 */

namespace Lidaa\TwigBundle\DependencyInjection;

use Symfony\Component\Config\Definition\Builder\TreeBuilder;
use Symfony\Component\Config\Definition\ConfigurationInterface;
use Symfony\Component\Config\Definition\Builder\ArrayNodeDefinition;

/**
 * Configuration
 *
 * @author Lidaa <aa_dil@hotmail.fr>
 */
class Configuration implements ConfigurationInterface
{
    /**
     * {@inheritDoc}
     */
    public function getConfigTreeBuilder()
    {
        $treeBuilder = new TreeBuilder();
        $rootNode = $treeBuilder->root('lidaa_twig');

        $this->addFormSection($rootNode);

        return $treeBuilder;
    }
    
    /**
     * addFormSection
     * @param ArrayNodeDefinition $rootNode
     */
    private function addFormSection(ArrayNodeDefinition $rootNode)
    {
        $rootNode
            ->children()
                ->arrayNode('form')
                    ->addDefaultsIfNotSet()
                    ->fixXmlConfig('resource')
                    ->children()
                        ->arrayNode('resources')
                            ->addDefaultsIfNotSet()
                            ->defaultValue(array('LidaaTwigBundle:Form:form_layout.html.twig'))
                            ->validate()
                                ->ifTrue(function($v) { return !in_array('LidaaTwigBundle:Form:form_layout.html.twig', $v); })
                                ->then(function($v){
                                    return array_merge(array('LidaaTwigBundle:Form:form_layout.html.twig'), $v);
                                })
                            ->end()
                            ->prototype('scalar')->end()
                        ->end()
                    ->end()
                ->end()
            ->end()
        ;
    }
}
