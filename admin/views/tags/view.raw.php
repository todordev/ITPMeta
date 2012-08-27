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

// No direct access
defined('_JEXEC') or die;

jimport('joomla.application.component.view');

class ITPMetaViewTags extends JView {
    
    protected $items;
    
    /**
     * Display the view
     */
    public function display($tpl = null){
        
        $app = JFactory::getApplication();
        /** @var $app JAdministrator **/
        
        $model            = $this->getModel();
        $model->setState("id", $app->input->get("id"));
        
        $this->items      = $model->getItems();

        parent::display($tpl);
        
    }
    
}
