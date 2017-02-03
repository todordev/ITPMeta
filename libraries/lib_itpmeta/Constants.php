<?php
/**
 * @package      Itpmeta
 * @subpackage   Constants
 * @author       Todor Iliev
 * @copyright    Copyright (C) 2017 Todor Iliev <todor@itprism.com>. All rights reserved.
 * @license      GNU General Public License version 3 or later; see LICENSE.txt
 */

namespace Itpmeta;

defined('JPATH_PLATFORM') or die;

/**
 * This class contains some constants.
 *
 * @package      Itpmeta
 * @subpackage   Constants
 */
class Constants
{
    // Auto-update states
    const AUTOUPDATE_ENABLED  = 1;
    const AUTOUPDATE_DISABLED = 0;

    // Text handling types.
    const NO_SPLIT = false;

    const CONTAINER_URI = 'com_itpmeta.uri';
    const CACHE_URI = 'com_itpmeta.uri';

    const COLLECTION_TYPE_FULL = 0;
    const COLLECTION_TYPE_STRICT = 1;
}
