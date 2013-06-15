<?php
/**
 * Created by Rubikin Team.
 * ========================
 * Date: 2013-06-12
 * Time: 13:56:39
 *
 * Question? Come to our website at http://rubikin.com
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Nilead\BreadcrumbsBundle\Model;

/**
 * A breadcrumb trail is a set of links (breadcrumbs) that can help a user understand and navigate your site's hierarchy
 */
class Breadcrumbs
{
    protected $breadcrumbs;

    /**
     * Add item into breadcrumbs
     *
     * @param string $title The title of a breadcrumb
     * @param string $url   The URL of a breadcrumb
     *
     * @return seft
     */
    public function add(Item $item)
    {
        $this->breadcrumbs[] = $item;

        return $this;
    }

    /**
     * Retrieve breadcrumbs items array
     *
     * @return array
     */
    public function retrieve()
    {
        return $this->breadcrumbs;
    }

    /**
     * Clear all items in breadcrumbs
     *
     * @return self
     */
    public function reset()
    {
        $this->breadcrumbs = array();

        return $this;
    }
}