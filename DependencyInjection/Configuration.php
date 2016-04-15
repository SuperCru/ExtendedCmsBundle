<?php
/**
 * This file is part of the SuperCruExtendedCmsBundle
 * @copyright (c) 2015, SuperCru LLC
 */
namespace SuperCru\ExtendedCmsBundle\DependencyInjection;

use Symfony\Component\Config\Definition\Builder\TreeBuilder;
use Symfony\Component\Config\Definition\ConfigurationInterface;

/**
 * This is the class that validates and merges configuration from your app/config files
 * @author Kaelin Jacobson <kaelin@supercru.com>
 * @since 1.0Ï
 */
class Configuration implements ConfigurationInterface
{

    /**
     * {@inheritdoc}
     */
    public function getConfigTreeBuilder()
    {
        $treeBuilder = new TreeBuilder();
        $rootNode = $treeBuilder->root('super_cru_extended_cms');
        
        $rootNode->children()
                    ->scalarNode("site_path")
                        ->cannotBeEmpty()
                        ->defaultValue("/cms/content/site")
                    ->end()
                    ->booleanNode("use_bootstrap_container")
                        ->defaultTrue()
                    ->end()
                ->end();

        return $treeBuilder;
    }
}
