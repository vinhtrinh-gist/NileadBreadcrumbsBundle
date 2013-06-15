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

/**
 * Item Resolver Interface
 */
interface ItemResolverInterface
{
    /**
     * Returns item to add.
     * It takes a raw item (array or string) defined in parameters.
     *
     * @param mixed $item
     *
     * @return Item
     */
    public function resolve($item);
}