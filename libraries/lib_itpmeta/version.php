<?php
/**
 * @package      ITPMeta
 * @subpackage   Libraries
 * @author       Todor Iliev
 * @copyright    Copyright (C) 2010 Todor Iliev <todor@itprism.com>. All rights reserved.
 * @license      http://www.gnu.org/copyleft/gpl.html GNU/GPL
 * ITPMeta is free software. This vpversion may have been modified pursuant
 * to the GNU General Public License, and as distributed it includes or
 * is derivative of works licensed under the GNU General Public License or
 * other free or open source software licenses.
 */

defined('JPATH_PLATFORM') or die;

class ItpMetaVersion {
	
    /**
     * Extension name
     * 
     * @var string
     */
    public $product    = 'ITP Meta';
    
    /**
     * Main Release Level
     * 
     * @var integer
     */
    public $release    = '3';
    
    /**
     * Sub Release Level
     * 
     * @var integer
     */
    public $devLevel  = '7';
    
    /**
     * Release Type
     * 
     * @var integer
     */
    public $releaseType  = 'Lite';
    
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
    public $releaseDate= '7-July-2013';
    
    /**
     * License
     * 
     * @var string
     */
    public $license  = '<a href="http://www.gnu.org/copyleft/gpl.html" target="_blank">GNU/GPL</a>';
    
    /**
     * Copyright Text
     * 
     * @var string
     */
    public $copyright  = '&copy; 2010 ITPrism. All rights reserved.';
    
    /**
     * URL
     * 
     * @var string
     */
    public $url        = '<a href="#" target="_blank">ITP Meta</a>';

    /**
     * Backlink
     * 
     * @var string
     */
    public $backlink   = '<div style="width:100%; text-align: center; font-size: xx-small; margin-top: 10px;"><a href="http://itprism.com/free-joomla-extensions/others/open-graph-meta" target="_blank">Joomla! open graph</a></div>';
    
    /**
     * Developer
     * 
     * @var string
     */
    public $developer  = '<a href="http://itprism.com" target="_blank">ITPrism</a>';
    
    /**
     *  Build long format of the verion text
     *
     * @return string Long format vpversion
     */
    public function getLongVersion() {
        
    	return 
    	   $this->product .' '. $this->release .'.'. $this->devLevel .' ' . 
    	   $this->devStatus . ' '. $this->releaseDate;
    }

    /**
     *  Build long format of the verion text
     *
     * @return string Long format version
     */
    public function getMediumVersion() {
        
    	return 
    	   $this->release .'.'. $this->devLevel .' ' . 
    	   $this->releaseType . ' ( ' .$this->devStatus . ' )';
    } 
    
    /**
     *  Build short format of the vpversion text
     *
     * @return string Short version format
     */
    public function getShortVersion() {
        return $this->release .'.'. $this->devLevel;
    }

}