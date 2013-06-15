<?php
/**
 * Created by Rubikin Team.
 * ========================
 * Date: 2013-06-12
 * Time: 15:49:31
 *
 * Question? Come to our website at http://rubikin.com
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Nilead\BreadcrumbsBundle\Twig;

use Exception;
use Twig_Extension;
use Twig_Function_Method;
use Twig_Filter_Method;
use Nilead\BreadcrumbsBundle\Model\Item;
use Nilead\BreadcrumbsBundle\Model\Breadcrumbs;
use Nilead\BreadcrumbsBundle\Templating\BreadcrumbsTemplate;
use Symfony\Component\DependencyInjection\ContainerInterface;

/**
 * Breadcrumbs Extension
 */
class BreadcrumbsExtension extends Twig_Extension
{
    protected $container;
    protected $breadcrumbsTemplate;

    public function __construct(ContainerInterface $container, BreadcrumbsTemplate $breadcrumbsTemplate)
    {
        $this->container = $container;
        $this->breadcrumbsTemplate = $breadcrumbsTemplate;
    }

    /**
     * Returns a list of functions to add to the existing list.
     *
     * @return array An array of functions
     */
    public function getFunctions()
    {
        return array(
            'nilead_breadcrumbs'  => new Twig_Function_Method($this, 'renderBreadcrumbs')
        );
    }

    /**
     * Renders the breadcrumbs
     *
     * @param  array  $options
     * @return string
     */
    public function renderBreadcrumbs(array $options = array())
    {
        // get current route id
        $routeId = $this->container->get('request')->get('_route');

        try {
            $breadcrumbs = $this->build(
                $this->container->parameters['breadcrumbs'][$routeId]
            );
        } catch(Exception $e) {
            throw $e;
        }

        return $this->breadcrumbsTemplate->render($breadcrumbs, $options);
    }

    /**
     * Returns the name of the extension.
     *
     * @return string The extension name
     */
    public function getName()
    {
        return "nilead_breadcrumbs";
    }

    /**
     * Build breadcrumbs
     *
     * @param $options
     * @return Breadcrumbs
     */
    private function build(array $items = array())
    {
        $breadcrumbs = $this->container->get('nilead.model.breadcrumbs');
        $itemResolver = $this->container->get('nilead.resolver.breadcrumb_item');

        foreach ($items as $item) {
            if ($item = $itemResolver->resolve($item)) {
                if ($item instanceof Item) {
                    $breadcrumbs->add($item);
                } else if (is_array($item) && ! empty($item)) {
                    foreach ($item as $breacrumbItem) {
                        $breadcrumbs->add($breacrumbItem);
                    }
                }
            }
        }

        return $breadcrumbs;
    }
}