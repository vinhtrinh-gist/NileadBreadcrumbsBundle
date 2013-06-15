<?php
/**
 * Created by Rubikin Team.
 * ========================
 * Date: 2013-06-12
 * Time: 14:03:57
 *
 * Question? Come to our website at http://rubikin.com
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Nilead\BreadcrumbsBundle\Model;

/**
 * Breadcrumb Item Model
 */
class Item
{
    /**
     * The title of a breadcrumb
     *
     * @var string
     */
    protected $title;

    /**
     * The URL of a breadcrumb
     *
     * @var string
     */
    protected $url;


    /**
     * The constructor
     *
     * @param string $title The title of a breadcrumb
     * @param string $url  The URL of a breadcrumb
     */
    public function __construct($title = null, $url = null)
    {
        is_null($title) || $this->title = $title;
        is_null($url)  || $this->url = $url;
    }

    /**
     * Gets the title
     *
     * @return string
     */
    public function getTitle()
    {
        return $this->title;
    }

    /**
     * Sets the title
     *
     * @param string $title The title of a breadcrumb
     *
     * @return self
     */
    public function setTitle($title)
    {
        $this->title = $title;

        return $this;
    }

    /**
     * Gets the URL of a breadcrumb
     *
     * @return string
     */
    public function getUrl()
    {
        return $this->url;
    }

    /**
     * Sets the URL of a breadcrumb
     *
     * @param string $url The URL of a breadcrumb
     *
     * @return self
     */
    public function setUrl($url)
    {
        $this->url = $url;

        return $this;
    }

    /**
     * Check item's URL is set or not
     *
     * @return boolean
     */
    public function hasUrl()
    {
        return ! empty($this->url);
    }
}