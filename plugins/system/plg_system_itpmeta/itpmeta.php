<?php
/**
 * @package      ITPMeta
 * @subpackage   Plugins
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
* @package 		ITPMeta
* @subpackage	Plugins
*/
class plgSystemItpMeta extends JPlugin {
	
    const   COLLECTION_TYPE_STRICT     = 1;
    
    private $uriString = "";
    
    public function init() {
	    
        jimport("itpmeta.uri");
        
	    // Get current URI
        $uri  = JUri::getInstance();
        $this->uriString  = $uri->toString(array('path', 'query'));
        
	}
	
	/**
	 * Put tags into the HEAD tag
	 * 
	 */
	public function onBeforeCompileHead() {
	    
	    // Check for restrictions
	    if($this->isRestricted()) {
	        return;
	    }
	    
	    // Initialize URI string
	    $this->init();
	    
        // If user want to put tags after the <head> tag
        // leave from this method. It is the method that puts tags to the head standardly.
        if($this->params->get("tags_position", 0)) {
            return;
        }
        
        $document = JFactory::getDocument();
        /** @var $document JDocumentHTML **/
        
        // Load tags for current address
        $itpUri  = ITPMetaUri::getInstance($this->uriString);
        $tags    = $itpUri->getTags();
        
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
     * Put some additional code - namespaces, 
     * additional code after body tag or before closing body tag.
     */
	public function onAfterRender() {
		
	    // Check for restrictions
	    if($this->isRestricted()) {
	        return;
	    }
        
        // Get document buffer
        $buffer = JResponse::getBody();
        
        switch($this->params->get("tags_position", 0)) {
            case 1:
                 $buffer = $this->putAfterHead($buffer);
                break;
            case 2:
                 $buffer = $this->putAfterTitle($buffer);
                break;
        }
        
        // Put open graph namespace in the HTML element
        $buffer = $this->putNamespaces($this->params, $buffer);
        
        // Add code after body tag and before closing body tag
        $buffer = $this->putAdditionalCode($buffer);
        
        JResponse::setBody($buffer);
        
	}
	
	private function isRestricted() {
	    
	    $app = JFactory::getApplication();
        /** @var $app JSite **/

        if($app->isAdmin()) {
            return true;
        }
        
        $document = JFactory::getDocument();
        /** @var $document JDocumentHTML **/
        
        $type = $document->getType();
        if(strcmp("html",$type) != 0) {
             return true;   
        }
        
        // It works only for GET request
        $method = $app->input->getMethod();
        if(strcmp("GET", $method) !== 0) {
            return true;
        }
        
        // Check component enabled
	    if (!JComponentHelper::isEnabled('com_itpmeta', true)) {
            return true;
        }
        
        return false;
	}
	
	
	private function putAfterHead($buffer) {
	    
	    // Load tags for current address
	    $itpUri  = ITPMetaUri::getInstance($this->uriString);
	    $tags    = $itpUri->getTags();
	    
        if(empty($tags)) {
            return $buffer;
        }
        
        // Add metadata
        if(!empty($tags)) {
            $output = "";
            $items  = array();
            foreach($tags as $tag) {
                if(!empty($tag->output)) {
                    $items[] = JString::trim($tag->output);
                }
            }
            
            if(!empty($items)) {
                $output = implode("\n", $items);
            }
            $matches = array();
	        if(preg_match('/(<head.*?>)/i', $buffer, $matches)) {
	            $afterHead = $matches[0]."\n".$output;
	            $buffer = str_replace($matches[0], $afterHead, $buffer);
	        }
        }
	    
        return $buffer;
	} 
	
	private function putAfterTitle($buffer) {
	    
	    // Load tags for current address
        $itpUri  = ITPMetaUri::getInstance($this->uriString);
        $tags    = $itpUri->getTags();
        
        if(empty($tags)) {
            return $buffer;
        }
        
        // Add metadata
        if(!empty($tags)) {
            $output = "</title>\n";
            $items  = array();
            foreach($tags as $tag) {
                if(!empty($tag->output)) {
                    $items[] = JString::trim($tag->output);
                }
            }
            
            if(!empty($items)) {
                $output .= implode("\n", $items);
            }
	        $buffer = str_replace('</title>', $output, $buffer);
        }
	    
        return $buffer;
	} 
	
	/**
	 * Add additional code after body tag and before closing body tag.
	 * 
	 * @param string $buffer
	 */
	private function putAdditionalCode($buffer) {
	    
	    $itpUri = ITPMetaUri::getInstance($this->uriString);
	    
	    // If the URI does not exist or not published
	    // we don't change the buffer
	    if(!$itpUri->id) {
	        return $buffer;
	    }
	    
	    if(!empty($itpUri->after_body_tag)) {
	        $matches = array();
	        if(preg_match('/(<body.*?>)/i', $buffer, $matches)) {
	            $afterBody = $matches[0]."\n".$itpUri->after_body_tag;
	            $buffer = str_replace($matches[0], $afterBody, $buffer);
	        }
	    }
	    
	    if(!empty($itpUri->before_body_tag)) {
            $beforeBody  = "\n".$itpUri->before_body_tag."\n</body>";
            $buffer     = str_replace("</body>", $beforeBody, $buffer);
	    }
	    
	    return $buffer;
	}
	
	/**
	 * Generate and put namespace schemes to the HTML tag
	 * 
	 * @param object $params Component parameters
	 * @param string $buffer Output buffer
	 */
	private function putNamespaces($params, $buffer) {
	    
	    $prefixes = array();
	    
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
            
            $string   = 'prefix="{STRING}"';
            
            $prefix   = implode(" ", $prefixes);
            
            $string   = str_replace("{STRING}", $prefix, $string);
            
            $newHtmlAttr = '<html '.$string; 
            $buffer   = str_replace("<html", $newHtmlAttr, $buffer);
        }
        
        return $buffer;
	}
	
}