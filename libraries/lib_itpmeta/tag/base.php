<?php
/**
 * @package      ITPMeta
 * @subpackage   Libraries
 * @author       Todor Iliev
 * @copyright    Copyright (C) 2010 Todor Iliev <todor@itprism.com>. All rights reserved.
 * @license      http://www.gnu.org/copyleft/gpl.html GNU/GPL
 * ITPMeta is free software. This version may have been modified pursuant
 * to the GNU General Public License, and as distributed it includes or
 * is derivative of works licensed under the GNU General Public License or
 * other free or open source software licenses.
 */

defined('JPATH_PLATFORM') or die;

abstract class ITPMetaTagBase {
    
    protected $name;
    protected $type;
    protected $title;
    protected $tag;
    protected $content;
    protected $output;
    
	abstract public function getOutput();
    abstract public function setOutput($output);
    
    public function __construct($name = null) {
        $this->name    = $name;
        
        if(!empty($this->name)) {
            $tagData     = $this->loadTagData();
            $this->type  = JArrayHelper::getValue($tagData, "type");
            $this->title = JArrayHelper::getValue($tagData, "title");
            $this->tag   = JArrayHelper::getValue($tagData, "tag");
        }
    }
    
    public function getName() {
        return $this->name;
    }
    
    public function setName($name) {
        $this->name = $name;
        return $this;
    }
    
    public function getType() {
        return $this->type;
    }
    
    public function setType($type) {
        $this->type = $type;
    }
    
    public function getContent() {
        return $this->content;
    }
    
    public function setContent($content) {
        $this->content = $content;
        return $this;
    }
    
    public function getTag() {
        return $this->tag;
    }
    
    public function setTag($tag) {
        $this->tag = $tag;
        return $this;
    }
    
	/**
     * @return the $title
     */
    public function getTitle() {
        return $this->title;
    }

	/**
     * @param string $title
     */
    public function setTitle($title) {
        $this->title = $title;
        return $this;
    }
    
    public function get($property) {
        return (isset($this->$property)) ? $this->$property : null;
    }
    
    public function set($property, $value) {
        $this->$property = $value;
        return $this;
    }
    
    protected function loadTagData($name = null) {
        
        if(isset($name)) {
            $this->name = $name;
        }
        
        $tag = "";
        
        switch($this->name) {
            
            // Basic OpenGraph tags
            case "ogtitle":
                $tag = array(
                	"title"=>'Open Graph Title [og:title]',
                	"type" =>'og:title',
                	"tag"  =>'<meta property="og:title" content="{PAGE_TITLE}" />'
                );
                break; 

            case "ogdescription":
                $tag = array(
                	"title"=>'Open Graph Description [og:description]',
                	"type" =>'og:description',
                	"tag"  =>'<meta property="og:description" content="{PAGE_DESCRIPTION}" />'
                );
                break; 
                
            case "ogimage":
                $tag = array(
                	"title"=>'Open Graph Image [og:image]',
                	"type" =>'og:image',
                	"tag"  =>'<meta property="og:image" content="{IMAGE_URL}" />'
                );
                break; 
                
            case "ogurl":
                $tag = array(
                	"title"=>'Open Graph URL [og:url]',
                	"type" =>'og:url',
                	"tag"  =>'<meta property="og:url" content="{URL}" />'
                );
                break; 
                
            case "ogarticle_published_time":
                $tag = array(
                	"title"=>'Published Time [article:published_time]',
                	"type" =>'article:published_time',
                	"tag"  =>'<meta property="article:published_time" content="{DATETIME}">'
                );
                break;
                
            case "ogarticle_modified_time":
                $tag = array(
                	"title"=>'Modified Time [article:modified_time]',
                	"type" =>'article:modified_time',
                	"tag"  =>'<meta property="article:modified_time" content="{DATETIME}"> '
                );
                break;
                
            // SEO
            case "seo_canonical":
                $tag = array(
                	"title"=>'Canonical Link [rel:canonical]',
                	"type" =>'rel:canonical',
                	"tag"  =>'<link rel="canonical" href="{URL}" />'
                );
                break;
                
            // Twitter Card tags
            case "twitter_card_title":
                $tag = array(
                	"title"=>'Twitter Card Title [twitter:title]',
                	"type" =>'twitter:title',
                	"tag"  =>'<meta property="twitter:title" content="{MAX_70_SYMBOLS}" />'
                );
                break;

            case "twitter_card_description":
                $tag = array(
                	"title"=>'Twitter Card Description [twitter:description]',
                	"type" =>'twitter:description',
                	"tag"  =>'<meta property="twitter:description" content="{DESCRIPTION}" />'
                );
                break;
                
            case "twitter_card_url":
                $tag = array(
                	"title"=>'Twitter Card URL [twitter:url]',
                	"type" =>'twitter:url',
                	"tag"  =>'<meta property="twitter:url" content="{URL}" />'
                );
                break;
                
            case "twitter_card_image":
                $tag = array(
                	"title"=>'Twitter Card Image [twitter:image]',
                	"type" =>'twitter:image',
                	"tag"  =>'<meta property="twitter:image" content="{URL}" />'
                );
                break;
                
            case "twitter_card_image_src":
                $tag = array(
                    "title"=>'Twitter Card Image SRC [twitter:image:src]',
                    "type" =>'twitter:image:src',
                    "tag"  =>'<meta property="twitter:image:src" content="{URL}" />'
                );
                break;
                
            default:
                break;
        }
        
        return $tag;
    }
    
    
}