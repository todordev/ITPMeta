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
        
        // Register the component helper
        $helperPath = JPATH_ROOT . DIRECTORY_SEPARATOR. "administrator" . DIRECTORY_SEPARATOR . "components" . DIRECTORY_SEPARATOR ."com_itpmeta". DIRECTORY_SEPARATOR."helpers" . DIRECTORY_SEPARATOR;
        JLoader::register("ItpMetaHelper", $helperPath . "helper.php");
        
        // Register the component version class
        $libraryPath = JPATH_ROOT . DIRECTORY_SEPARATOR. "administrator" . DIRECTORY_SEPARATOR . "components" . DIRECTORY_SEPARATOR ."com_itpmeta". DIRECTORY_SEPARATOR."libraries" . DIRECTORY_SEPARATOR;
        JLoader::register("ItpMetaVersion", $libraryPath . "version.php");
        
	}
    
	public function onBeforeCompileHead() {
	    
	    $app = JFactory::getApplication();
        /** @var $app JSite **/

        if($app->isAdmin()) {
            return;
        }
        
	    if (!JComponentHelper::isEnabled('com_itpmeta', true)) {
            return;
        }

        $document = JFactory::getDocument();
        /** @var $document JDocumentHTML **/
        
        $type = $document->getType();
        
        if(strcmp("html",$type) != 0) {
             return;   
        }
        
        // Gets current URL
        $uri    = JFactory::getURI();
        $path   = $uri->getPath();
        $query  = $uri->getQuery();
        if(!empty($query)) {
            $path .= "?".$query;
        }
        
        // Load all tags for this address
        $tags = ItpMetaHelper::getTags($path);
        
        // Add metadata
        if(!empty($tags)) {
            foreach($tags as $tag) {
                
                $tag->output = JString::trim($tag->output);
                if(!empty($tag->output)) {
                    $document->addCustomTag($tag->output);
                }
            }
        }
        
	}
	
	/**
     * Put open graph namespace in the document
     */
	public function onAfterRender() {
		
	    $app = JFactory::getApplication();
        /** @var $app JSite **/

        if($app->isAdmin()) {
            return;
        }
        
        // Check component options
        $params = JComponentHelper::getParams('com_itpmeta');
		if (!JComponentHelper::isEnabled('com_itpmeta', true)) {
			return;
        }
        
	    $document = JFactory::getDocument();
        /** @var $document JDocumentHTML **/
        
        $type = $document->getType();
        if(strcmp("html",$type) !=0) {
             return;   
        }
        
        $buffer = JResponse::getBody();
        
        // Add open graph namespace in the html element
	    if($params->get("add_opengraph_scheme", 0)) {
            $newHtmlAttr = '<html xmlns:og="http://ogp.me/ns#" '; 
            $buffer = str_replace("<html", $newHtmlAttr, $buffer);
        }
        
        // Add backlink to the end of the page
        $version =  new ItpMetaVersion();
        $versionCode = $version->backlink . "</body>";
        $buffer = str_replace("</body>", $versionCode, $buffer);
        
        JResponse::setBody($buffer);
	}
}