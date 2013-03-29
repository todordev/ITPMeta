<?php
/**
 * @package      ITPrism Components
 * @subpackage   ITPMeta
 * @author       Todor Iliev
 * @copyright    Copyright (C) 2010 Todor Iliev <todor@itprism.com>. All rights reserved.
 * @license      http://www.gnu.org/copyleft/gpl.html GNU/GPL
 * ITPMeta is free software. This version may have been modified pursuant
 * to the GNU General Public License, and as distributed it includes or
 * is derivative of works licensed under the GNU General Public License or
 * other free or open source software licenses.
 */

// Check to ensure this file is included in Joomla!
defined('_JEXEC') or die;

jimport( 'joomla.application.component.controlleradmin' );

/**
 * ITPMeta URLs Controller
 *
 * @package     ITPrism Components
 * @subpackage  ITPMeta
  */
class ItpMetaControllerGlobals extends JControllerAdmin {
    
    private    $defaultLink = 'index.php?option=com_itpmeta';
    
    /**
     * @var     string  The prefix to use with controller messages.
     * @since   1.6
     */
    protected $text_prefix = 'COM_ITPMETA';
    
    /**
     * Proxy for getModel.
     * @since   1.6
     */
    public function getModel($name = 'Global', $prefix = 'ItpMetaModel', $config = array('ignore_request' => true)) {
        
        $model = parent::getModel($name, $prefix, $config);
        return $model;
    }
    
    public function backToDashboard() {
        $this->setRedirect( JRoute::_($this->defaultLink, false) );
    }
    
}