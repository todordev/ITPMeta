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
defined('_JEXEC') or die;

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
        
	    $document = JFactory::getDocument();
        /** @var $document JDocumentHTML **/
        
        $type = $document->getType();
        if(strcmp("html",$type) !=0) {
             return;   
        }
        
	    // Check component options
		if (!JComponentHelper::isEnabled('com_itpmeta', true)) {
			return;
        }
        
        $params = JComponentHelper::getParams('com_itpmeta');
        
        $buffer = JResponse::getBody();
        
        // Put open graph namespace in the HTML element
        $buffer = $this->putNamespaces($params, $buffer);
        
        // Add backlink to the end of the page
        $version =  new ItpMetaVersion();
        $versionCode = $version->backlink . "</body>";
        $buffer = str_replace("</body>", $versionCode, $buffer);
        
        JResponse::setBody($buffer);
	}
	
	/**
	 * 
	 * Generate and put namespace schemes to the HTML tag
	 * @param object $params Component parameters
	 * @param string $buffer Output buffer
	 */
	private function putNamespaces($params, $buffer) {
	    
	    $prefixes = array();
	    $string   = 'prefix="{STRING}"';
	    
	    // OpenGraph namespace
	    if($params->get("opengraph_scheme", 0)) {
	        $prefixes[] = "og: http://ogp.me/ns#";
        }
        
	    // Facebook namespace
	    if($params->get("facebook_scheme", 0)) {
	        $prefixes[] = "fb: http://ogp.me/ns/fb#";
        }
        
	    // OpenGraph article namespace
	    if($params->get("opengraph_article_scheme", 0)) {
            $prefixes[] = "article: http://ogp.me/ns/article#";
        }
        
	    // OpenGraph blog namespace
	    if($params->get("opengraph_blog_scheme", 0)) {
            $prefixes[] = "blog: http://ogp.me/ns/blog#";
        }
        
	    // OpenGraph book namespace
	    if($params->get("opengraph_book_scheme", 0)) {
            $prefixes[] = "book: http://ogp.me/ns/book#";
        }
        
	    // OpenGraph profile namespace
	    if($params->get("opengraph_profile_scheme", 0)) {
            $prefixes[] = "profile: http://ogp.me/ns/profile#";
        }
        
	    // OpenGraph video namespace
	    if($params->get("opengraph_video_scheme", 0)) {
            $prefixes[] = "video: http://ogp.me/ns/video#";
        }
        
	    // OpenGraph website namespace
	    if($params->get("opengraph_website_scheme", 0)) {
            $prefixes[] = "website: http://ogp.me/ns/website#";
        }
        
	    // OpenGraph music namespace
	    if($params->get("opengraph_music_scheme", 0)) {
            $prefixes[] = "music: http://ogp.me/ns/music#";
        }
        
        if(!empty($prefixes)) {
            $prefix = implode(" ", $prefixes);
            $string = str_replace("{STRING}", $prefix, $string);
            
            $newHtmlAttr = '<html '.$string; 
            $buffer = str_replace("<html", $newHtmlAttr, $buffer);
        }
        
        return $buffer;
	}
}