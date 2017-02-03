<?php
/**
 * @package      Itpmeta
 * @subpackage   URLs
 * @author       Todor Iliev
 * @copyright    Copyright (C) 2017 Todor Iliev <todor@itprism.com>. All rights reserved.
 * @license      GNU General Public License version 3 or later; see LICENSE.txt
 */

namespace Itpmeta\Url;

defined('JPATH_PLATFORM') or die;

/**
 * This class provides functionality for managing URIs.
 *
 * @package      Itpmeta
 * @subpackage   URLs
 */
abstract class UrlHelper
{
    protected static $uri;

    /**
     * Prepare some specific URLs that comes from components.
     *
     * @throws \Exception
     *
     * @return \JUri
     */
    public static function getUri()
    {
        if (self::$uri === null) {
            $app        = \JFactory::getApplication();
            $option     = $app->input->getCmd('option');

            self::$uri  = clone \JUri::getInstance();

            switch ($option) {
                case 'com_virtuemart':
                    $query = self::$uri->getQuery(true);

                    if (array_key_exists('showall', $query)) {
                        unset($query['showall']);
                    }

                    self::$uri->setQuery($query);

                    break;
            }
        }

        return self::$uri;
    }

    /**
     * Get URI string.
     *
     * @throws \Exception
     * @return string
     */
    public static function getCleanUri()
    {
        $filter    = \JFilterInput::getInstance();

        $uri       = self::getUri();
        $uriString = $uri->toString(array('path', 'query'));
        $uriString = $filter->clean($uriString);

        return $uriString;
    }
}
