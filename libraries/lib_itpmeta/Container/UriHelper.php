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
use Prism\Utilities\StringHelper;
use Itpmeta\Constants;
use Itpmeta\Url\Uri;

defined('JPATH_PLATFORM') or die;

/**
 * This class provides functionality to prepare and inject URL object in the container.
 *
 * @package      Itpmeta
 * @subpackage   Helpers
 */
trait UriHelper
{
    /**
     * Prepare URI object and inject it in the container.
     *
     * <code>
     * $keys = array(
     *    'uri' => '/project/1',
     *    'uri_id' => 1
     * );
     *
     * $this->prepareUri($container, $keys);
     * $uri = $this->getUri($container, $keys);
     * </code>
     *
     * @param Container $container
     * @param array $keys
     *
     * @throws \RuntimeException
     * @throws \InvalidArgumentException
     * @throws \UnexpectedValueException
     * @throws \OutOfBoundsException
     *
     * @return Uri
     */
    protected function prepareUri($container, array $keys)
    {
        $uri   = array_key_exists('uri', $keys) ? $keys['uri'] : null;
        $uriId = array_key_exists('uri_id', $keys) ? (int)$keys['uri_id'] : 0;

        if ($uriId > 0) {
            $hash = StringHelper::generateMd5Hash(Constants::CONTAINER_URI, $uriId);
        } else {
            $hash = StringHelper::generateMd5Hash(Constants::CONTAINER_URI, $uri);
        }

        if (!$container->exists($hash)) {
            $uri = new Uri(\JFactory::getDbo());
            $uri->load($keys);

            $container->set($hash, $uri);
        }
    }

    /**
     * Return URI.
     *
     * <code>
     * $keys = array(
     *    'uri' => '/project/1',
     *    'uri_id' => 1
     * );
     *
     * $this->prepareUri($container, $keys);
     * $uri = $this->getUri($container, $keys);
     * </code>
     *
     * @param Container $container
     * @param array $keys
     *
     * @throws \RuntimeException
     * @throws \InvalidArgumentException
     * @throws \UnexpectedValueException
     * @throws \OutOfBoundsException
     *
     * @return Uri
     */
    protected function getUri($container, array $keys)
    {
        $uri   = array_key_exists('uri', $keys) ? (string)$keys['uri'] : '';
        $uriId = array_key_exists('uri_id', $keys) ? (int)$keys['uri_id'] : 0;

        if ($uriId > 0) {
            $hash = StringHelper::generateMd5Hash(Constants::CONTAINER_URI, $uriId);
        } else {
            $hash = StringHelper::generateMd5Hash(Constants::CONTAINER_URI, $uri);
        }

        $uri = null;
        if ($uriId > 0 or $uri !== '') {
            if ($container->exists($hash)) {
                $uri = $container->get($hash);
            } else {
                $this->prepareUri($container, $keys);
                $uri = $container->get($hash);
            }
        }

        return $uri;
    }
}
