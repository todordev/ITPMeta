<?php
/**
 * @package      ITPrism Plugins
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
defined('_JEXEC') or die();

jimport('joomla.application.component.helper');
jimport('joomla.plugin.plugin');

/**
* ITPMeta plugin
*
* @package 		ITPrism Plugins
* @subpackage	ITPMeta
*/
class plgSystemItpMeta extends JPlugin {
	
	public function __construct(&$subject, $config = array()){
        
        parent::__construct($subject, $config);
	}
    
	public function onAfterDispatch() {
	    
	    if (!JComponentHelper::isEnabled('com_itpmeta', true)) {
            return;
        }

        $app = JFactory::getApplication();
        /* @var $app JApplication */

        if($app->isAdmin()) {
            return;
        }

        $document = JFactory::getDocument();
        /* @var $document JDocumentHTML */
        
        $type = $document->getType();
        
        if(strcmp("html",$type) != 0) {
             return;   
        }
        
        // Register the component helper
        $helperPath = JPATH_ROOT . DS. "administrator" . DS . "components" . DS ."com_itpmeta" . DS."helpers" . DS;
        JLoader::register("ItpMetaHelper", $helperPath . "itpmetahelper.php");
        
        // Gets current URL
        $uri    = JFactory::getURI();
        $path   = $uri->getPath();
        $query  = $uri->getQuery();
        
        if(!empty($query)) {
            $path .= "?".$query;
        }
        
        // Load all tags for this address
        $tags = ItpMetaHelper::getTags($path);
        
        // Get global metadata
        $componentParams = &JComponentHelper::getParams('com_itpmeta');
        $addGlobal  = $componentParams->get("addGlobal", 0);
        $globalTags = array();
        
        if($addGlobal){
            $tags_ = $componentParams->get("tags", "");
            if(!empty($tags_)) {
                $globalTags = explode("\n", $tags_);
            }
        }
        
        // Add metadata
        if(!empty($tags) OR !empty($globalTags)) {
            
            // Put tags for specified address
            if(!empty($tags)) {
                foreach($tags as $tag) {
                    $tag->content = JString::trim($tag->content);
                    if(!empty($tag->content)) {
                        $document->addCustomTag($tag->content);
                    }
                }
            }
            
            // Put global tags
            if(!empty($globalTags)) {
                foreach($globalTags as $tag) {
                    $tag = JString::trim($tag);
                    if(!empty($tag)) {
                        $document->addCustomTag($tag);
                    }
                }
            }
        }
        
	}
	
	/**
     * Put open graph namespace in the document
     */
	public function onAfterRender() {
		
		if (!JComponentHelper::isEnabled('com_itpmeta', true)) {
			return;
        }

	    $app = JFactory::getApplication();
        /* @var $app JApplication */

        if($app->isAdmin()) {
            return;
        }
        
	    $document = JFactory::getDocument();
        /* @var $document JDocumentHTML */
        
        $type = $document->getType();
        if(strcmp("html",$type) !=0) {
             return;   
        }
        
        $buffer = JResponse::getBody();
        
        // Add open graph namespace in the html element
        $newHtmlAttr = '<html xmlns:og="http://ogp.me/ns#" '; 
        $buffer = str_replace("<html", $newHtmlAttr, $buffer);
        
        JResponse::setBody($buffer);
	}
}