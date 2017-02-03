<?php
/**
 * @package      Itpmeta
 * @subpackage   Helpers
 * @author       Todor Iliev
 * @copyright    Copyright (C) 2017 Todor Iliev <todor@itprism.com>. All rights reserved.
 * @license      GNU General Public License version 3 or later; see LICENSE.txt
 */

namespace Itpmeta\Container;

use Joomla\DI\Container;
use Itpmeta\Url\Uri;

defined('JPATH_PLATFORM') or die;

/**
 * This class provides functionality that returns objects from the container.
 * This class uses helper traits of the container to prepare and fetch the objects.
 *
 * @package      Itpmeta
 * @subpackage   Helpers
 */
class Helper
{
    use UriHelper;

    /**
     * Return URI object.
     *
     * <code>
     * $keys = array(
     *    'uri' => '/project/1',
     *    'uri_id' => 1
     * );
     *
     * $helper  = new Itpmeta\Container\Helper();
     * $uri     = $this->fetchUri($container, $keys);
     * </code>
     *
     * @param Container $container
     * @param array $keys
     *
     * @throws \RuntimeException
     * @throws \InvalidArgumentException
     * @throws \OutOfBoundsException
     * @throws \UnexpectedValueException
     *
     * @return Uri
     */
    public function fetchUri($container, array $keys)
    {
        return $this->getUri($container, $keys);
    }
}
