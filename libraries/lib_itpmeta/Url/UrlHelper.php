<?php
/**
 * @package      ItpMeta
 * @subpackage   URLs
 * @author       Todor Iliev
 * @copyright    Copyright (C) 2015 Todor Iliev <todor@itprism.com>. All rights reserved.
 * @license      GNU General Public License version 3 or later; see LICENSE.txt
 */

namespace Itpmeta\Url;

use Prism;

defined('JPATH_PLATFORM') or die;

/**
 * This class provides functionality for managing URIs.
 *
 * @package      ItpMeta
 * @subpackage   URLs
 */
abstract class UrlHelper
{
    protected static $uri;

    /**
     * Prepare some specific URLs that comes from components.
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
}
