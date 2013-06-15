<?php
/**
 * Created by Rubikin Team.
 * ========================
 * Date: 2013-06-12
 * Time: 15:43:54
 *
 * Question? Come to our website at http://rubikin.com
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Nilead\BreadcrumbsBundle\DependencyInjection;

use Symfony\Component\Config\Definition\Builder\TreeBuilder;
use Symfony\Component\Config\Definition\ConfigurationInterface;

/**
 * This is the class that validates and merges configuration from your app/config files
 */
class Configuration implements ConfigurationInterface
{
    /**
     * {@inheritDoc}
     */
    public function getConfigTreeBuilder()
    {
        $treeBuilder = new TreeBuilder();
        $rootNode = $treeBuilder->root('nilead_breadcrumbs');

        $rootNode
            ->addDefaultsIfNotSet()
            // ->children()
            //     ->scalarNode("separator")->defaultValue("/")->end()
            //     ->scalarNode("separatorClass")->defaultValue("separator")->end()
            //     ->scalarNode("listId")->defaultValue("wo-breadcrumbs")->end()
            //     ->scalarNode("listClass")->defaultValue("breadcrumb")->end()
            //     ->scalarNode("itemClass")->defaultValue("")->end()
            //     ->scalarNode("linkRel")->defaultValue("")->end()
            //     ->scalarNode("locale")->defaultNull()->end()
            //     ->scalarNode("translation_domain")->defaultNull()->end()
            ->end()
        ;

        return $treeBuilder;
    }
}
