<?php
/**
* This file is part of SopinetBootstrapExtendBundle.
*
* (c) 2013 by Fernando Hidalgo - Sopinet
*/

namespace Sopinet\Bundle\BootstrapExtendBundle\DependencyInjection;

use Symfony\Component\Config\Definition\Builder\TreeBuilder;
use Symfony\Component\Config\Definition\ConfigurationInterface;

/**
* Configuration
*
* @codeCoverageIgnore
*/
class Configuration implements ConfigurationInterface
{
    /**
		* {@inheritDoc}
		*/
    public function getConfigTreeBuilder()
    {
        return $this->buildConfigTree();
    }

    private function buildConfigTree()
    {
        $treeBuilder = new TreeBuilder();
        $rootNode = $treeBuilder->root('sopinet_bootstrap_extend');

        $rootNode
            ->children()
								->booleanNode('include_jquery')->defaultValue(true)->end()
								->booleanNode('include_bootstrap')->defaultValue(true)->end()
								->scalarNode('output_dir')->defaultValue('include/')->end()
                ->scalarNode('assets_dir')
                    ->defaultValue('%kernel.root_dir%/../vendor/sopinet/bootstrap-extend-bundle/Sopinet/Bundle/BootstrapExtendBundle/Resources/public')
                ->end()
								->arrayNode('include')
									->prototype('scalar')
									->validate()
										->ifNotInArray(array('font-awesome','xeditable','jqueryui', 'jqueryuitouch', 'jsplumb', 'jcrop','datepicker','image-gallery','jqueryform','jwplayer','flexslider','easy-pie-chart','jquery-flot'))
										->thenInvalid('Invalid include library "%s"')
									->end()
								->end()
						->end();

/*
                ->scalarNode('output_dir')->defaultValue('')->end()
                ->scalarNode('assets_dir')
                    ->defaultValue('%kernel.root_dir%/../vendor/twitter/bootstrap')
                ->end()
                ->scalarNode('jquery_path')
                    ->defaultValue('%kernel.root_dir%/../vendor/jquery/jquery/jquery-1.9.1.js')
                ->end()
                ->scalarNode('less_filter')
                    ->defaultValue('less')
                    ->validate()
                        ->ifNotInArray(array('less', 'lessphp', 'none'))
                        ->thenInvalid('Invalid less filter "%s"')
                    ->end()
                ->end()
                ->booleanNode('include_responsive')->defaultValue(true)->end()
                ->arrayNode('auto_configure')
                    ->addDefaultsIfNotSet()
                    ->children()
                        ->booleanNode('assetic')->defaultValue(true)->end()
                        ->booleanNode('twig')->defaultValue(true)->end()
                        ->booleanNode('knp_menu')->defaultValue(true)->end()
                        ->booleanNode('knp_paginator')->defaultValue(true)->end()
                    ->end()
                ->end()
*/
  //          ->end();

        return $treeBuilder;
    }
}
