<?php
/**
 * @package      ITPMeta
 * @subpackage   Library
 * @author       Todor Iliev
 * @copyright    Copyright (C) 2014 Todor Iliev <todor@itprism.com>. All rights reserved.
 * @license      http://www.gnu.org/copyleft/gpl.html GNU/GPL
 */

defined('JPATH_PLATFORM') or die;

/**
 * CrowdFunding constants
 *
 * @package      CrowdFunding
 * @subpackage   Libraries
 */
class ITPMetaConstants
{
    // States
    const PUBLISHED   = 1;
    const UNPUBLISHED = 2;
    const TRASHED     = -2;

    // Mail modes - html and plain text.
    const MAIL_MODE_HTML       = true;
    const MAIL_MODE_PLAIN_TEXT = false;

    // Auto-update states
    const AUTOUPDATE_ENABLED  = 1;
    const AUTOUPDATE_DISABLED = 0;

    // Text handling types.
    const NO_SPLIT = false;
}