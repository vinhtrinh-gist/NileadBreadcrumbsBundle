<?php
/**
 * Created by Rubikin Team.
 * ========================
 * Date: 2013-06-12
 * Time: 17:41:25
 *
 * Question? Come to our website at http://rubikin.com
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Nilead\BreadcrumbsBundle\Templating;

use Symfony\Component\Templating\Helper\Helper;
use Symfony\Component\Templating\EngineInterface;
use Nilead\BreadcrumbsBundle\Model\Breadcrumbs;

/**
 * Breadcrumbs Tempalte Helper
 */
class BreadcrumbsTemplate extends Helper
{
    protected $templating;
    protected $breadcrumbs;
    protected $options = array();

    /**
     * @param EngineInterface $templating
     * @param Breadcrumbs $breadcrumbs
     * @param array $options
     */
    public function __construct(EngineInterface $templating, Breadcrumbs $breadcrumbs, array $options)
    {
        $this->templating  = $templating;
        $this->breadcrumbs = $breadcrumbs;
        $this->options = $options;
    }


    public function render(Breadcrumbs $breadcrumbs, array $options = array())
    {
        $this->options['breadcrumbs'] = $breadcrumbs;

        return $this->templating->render(
            'NileadBreadcrumbsBundle::breadcrumbs.html.twig',
            $this->resolveOptions($options)
        );
    }

    /**
     * @codeCoverageIgnore
     */
    public function getName()
    {
        return 'breadcrumbs';
    }

    /**
     * Merges user-supplied options from the view
     * with base config values
     *
     * @param array $options
     * @return array
     */
    private function resolveOptions(array $options = array())
    {
        return array_merge($this->options, $options);
    }
}