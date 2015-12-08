<?php
/**
 * @package      ItpMeta
 * @subpackage   Versions
 * @author       Todor Iliev
 * @copyright    Copyright (C) 2015 Todor Iliev <todor@itprism.com>. All rights reserved.
 * @license      GNU General Public License version 3 or later; see LICENSE.txt
 */

namespace Itpmeta;

defined('JPATH_PLATFORM') or die;

/**
 * Contains information about component version.
 *
 * @package ItpMeta
 * @subpackage Versions
 */
class Version
{
    /**
     * Extension name
     *
     * @var string
     */
    public $product = 'ITP Meta';

    /**
     * Main Release Level
     *
     * @var integer
     */
    public $release = '4';

    /**
     * Sub Release Level
     *
     * @var integer
     */
    public $devLevel = '3';

    /**
     * Release Type
     *
     * @var integer
     */
    public $releaseType = 'Pro';

    /**
     * Development Status
     *
     * @var string
     */
    public $devStatus = 'Stable';

    /**
     * Date
     *
     * @var string
     */
    public $releaseDate = '07 December, 2015';

    /**
     * License
     *
     * @var string
     */
    public $license = '<a href="http://www.gnu.org/licenses/gpl-3.0.en.html" target="_blank">GNU/GPLv3</a>';

    /**
     * Copyright Text
     *
     * @var string
     */
    public $copyright = '&copy; 2015 ITPrism. All rights reserved.';

    /**
     * URL
     *
     * @var string
     */
    public $url = '<a href="http://itprism.com/free-joomla-extensions/others/open-graph-meta" target="_blank">ITP Meta</a>';

    /**
     * Backlink
     *
     * @var string
     */
    public $backlink = '<div style="width:100%; text-align: center; font-size: xx-small; margin-top: 10px;"><a href="http://itprism.com/free-joomla-extensions/others/open-graph-meta" target="_blank">Joomla! open graph</a></div>';

    /**
     * Developer
     *
     * @var string
     */
    public $developer = '<a href="http://itprism.com" target="_blank">ITPrism</a>';

    /**
     * Minimum required version of Prism library.
     *
     * @var string
     */
    public $requiredPrismVersion = '1.0';

    /**
     *  Build long format of the version text.
     *
     * @return string Long format version.
     */
    public function getLongVersion()
    {
        return
            $this->product . ' ' . $this->release . '.' . $this->devLevel . ' ' .
            $this->devStatus . ' ' . $this->releaseDate;
    }

    /**
     *  Build long format of the version text.
     *
     * @return string Long format version
     */
    public function getMediumVersion()
    {
        return
            $this->release . '.' . $this->devLevel . ' ' .
            $this->releaseType . ' ( ' . $this->devStatus . ' )';
    }

    /**
     *  Build short format of the version text.
     *
     * @return string Short version format.
     */
    public function getShortVersion()
    {
        return $this->release . '.' . $this->devLevel;
    }
}
