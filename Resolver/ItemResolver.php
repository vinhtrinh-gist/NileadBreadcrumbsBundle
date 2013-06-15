<?php
/**
 * Created by Rubikin Team.
 * ========================
 * Date: 2013-06-13
 * Time: 14:54:00
 *
 * Question? Come to our website at http://rubikin.com
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Nilead\BreadcrumbsBundle\Resolver;

use Nilead\BreadcrumbsBundle\Model\Item;
use Symfony\Component\DependencyInjection\ContainerInterface;

/**
 * Resolver returns breadcrumb item.
 */
class ItemResolver implements ItemResolverInterface
{
    protected $container;

    public function __construct(ContainerInterface $container)
    {
        $this->container = $container;
    }

    /**
     * Returns item to add.
     * It takes a raw item (array or string) defined in parameters.
     *
     * @param mixed $item
     *
     * @return Item
     */
    public function resolve($item)
    {
        if (is_array($item) && array_key_exists('title', $item)) {
            $breadcrumbItem = new Item($item['title']);

            if (array_key_exists('url', $item)) {
                $breadcrumbItem->setUrl(
                    $this->container->get('router')->generate(
                        $item['url']
                    )
                );
            }

            return $breadcrumbItem;
        }

        if (is_string($item) && method_exists($this, $item)) {
            return $this->$item();
        }
    }

    /**
     * TODO: Move this method to CoreBundle
     * Generate array of breadcrumb items by product slug
     *
     * @return array
     */
    protected function CategoryTree()
    {
        $route = $this->container->get('router')->match(
            $this->container->get('request')->getPathInfo()
        );

        $taxons = $this
            ->container
            ->get('nilead.manager.product')
            ->findTaxons($route['slug'])
        ;

        $items = array();
        foreach ($taxons as $taxon) {
            $items[] = new Item(
                $taxon['name'],
                $this->container->get('router')->generate(
                    'nilead.frontend.category',
                    array('slug' => $taxon['slug'])
                )
            );
        }

        return $items;
    }

    /**
     * TODO: Move this method to CoreBundle
     * Generate breadcrumb item by product slug
     *
     * @return Item
     */
    protected function Category()
    {
        $route = $this->container->get('router')->match(
            $this->container->get('request')->getPathInfo()
        );

        $taxon = $this
            ->container
            ->get('nilead.manager.product')
            ->findTaxon($route['slug']);

        return new Item(
            $taxon['name'],
            $this->container->get('router')->generate(
                'nilead.frontend.category',
                array('slug' => $taxon['slug'])
            )
        );
    }

    /**
     * TODO: Move this method to CoreBundle
     * Generate breadcrumb item by product slug
     *
     * @return Item
     */
    protected function Product()
    {
        $route = $this->container->get('router')->match(
            $this->container->get('request')->getPathInfo()
        );

        $product = $this
            ->container->get('nilead.manager.product')
            ->findOneBy(array('slug' => $route['slug']))
        ;

        return new Item(
            $product->getName(),
            $this->container->get('router')->generate(
                $route['_route'],
                array('slug' => $product->getSlug())
            )
        );
    }
}