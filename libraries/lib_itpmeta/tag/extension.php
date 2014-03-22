<?php
/**
 * @package      ITPMeta
 * @subpackage   Libraries
 * @author       Todor Iliev
 * @copyright    Copyright (C) 2014 Todor Iliev <todor@itprism.com>. All rights reserved.
 * @license      http://www.gnu.org/copyleft/gpl.html GNU/GPL
 */

defined('JPATH_PLATFORM') or die;

jimport("itpmeta.tag");

class ITPMetaTagExtension extends ItpMetaTag {
    
    protected $name;
    protected $type;
    protected $title;
    protected $tag;
    protected $content;
    protected $output;
    
    public function load() {
        
        $tag = array();
        
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
        
        $this->bind($tag);
    }
    
    public function toArray() {
        
        return array(
            "title"   => $this->getTitle(),
            "type"    => $this->getType(),
            "tag"     => $this->getTag(),
            "content" => $this->getContent(),
            "output"  => $this->getOutput()
        );
        
    }
}