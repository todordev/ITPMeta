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

// no direct access
defined('_JEXEC') or die;

require_once (JPATH_COMPONENT_ADMINISTRATOR.DIRECTORY_SEPARATOR. "libraries" . DIRECTORY_SEPARATOR ."init.php");

// Include dependencies
jimport('joomla.application.component.controller');

// Get an instance of the controller prefixed
$controller = JController::getInstance("ItpMeta");

// Perform the Request task
$controller->execute(JFactory::getApplication()->input->getCmd('task'));
$controller->redirect();
