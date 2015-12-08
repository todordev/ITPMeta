<?php
/**
 * @package      ItpMeta
 * @subpackage   Tags
 * @author       Todor Iliev
 * @copyright    Copyright (C) 2015 Todor Iliev <todor@itprism.com>. All rights reserved.
 * @license      GNU General Public License version 3 or later; see LICENSE.txt
 */

namespace Itpmeta\Tag;

defined('JPATH_PLATFORM') or die;

/**
 * This class provides functionality for generating some general tags.
 *
 * @package      ItpMeta
 * @subpackage   Tags
 */
class ExtensionTag extends Base
{
    /**
     * This is the base class of extension tags.
     * This class prepares tags for extensions that will be used from plugins .
     *
     * <code>
     * $tagName = "ogtitle";
     *
     * $tag   = new ItpMeta\Tag\ExtensionTag(\JFactory::getDbo());
     * $tag->load($tagName);
     * </code>
     *
     * @param string $name
     * @return self
     */
    public function load($name)
    {
        $this->name = $name;

        $tag = array();

        switch ($this->name) {

            // Basic OpenGraph tags
            case 'ogtitle':
                $tag = array(
                    'title' => 'Open Graph Title [og:title]',
                    'type'  => 'og:title',
                    'tag'   => '<meta property="og:title" content="{PAGE_TITLE}" />'
                );
                break;

            case 'ogdescription':
                $tag = array(
                    'title' => 'Open Graph Description [og:description]',
                    'type'  => 'og:description',
                    'tag'   => '<meta property="og:description" content="{PAGE_DESCRIPTION}" />'
                );
                break;

            case 'ogimage':
                $tag = array(
                    'title' => 'Open Graph Image [og:image]',
                    'type'  => 'og:image',
                    'tag'   => '<meta property="og:image" content="{IMAGE_URL}" />'
                );
                break;

            case 'ogurl':
                $tag = array(
                    'title' => 'Open Graph URL [og:url]',
                    'type'  => 'og:url',
                    'tag'   => '<meta property="og:url" content="{URL}" />'
                );
                break;

            case 'ogarticle_published_time':
                $tag = array(
                    'title' => 'Published Time [article:published_time]',
                    'type'  => 'article:published_time',
                    'tag'   => '<meta property="article:published_time" content="{DATETIME}">'
                );
                break;

            case 'ogarticle_modified_time':
                $tag = array(
                    'title' => 'Modified Time [article:modified_time]',
                    'type'  => 'article:modified_time',
                    'tag'   => '<meta property="article:modified_time" content="{DATETIME}">'
                );
                break;

            // SEO
            case 'seo_canonical':
                $tag = array(
                    'title' => 'Canonical Link [rel:canonical]',
                    'type'  => 'rel:canonical',
                    'tag'   => '<link rel="canonical" href="{URL}" />'
                );
                break;

            // Twitter Card tags
            case 'twitter_card_title':
                $tag = array(
                    'title' => 'Twitter Card Title [twitter:title]',
                    'type'  => 'twitter:title',
                    'tag'   => '<meta name="twitter:title" content="{MAX_70_SYMBOLS}" />'
                );
                break;

            case 'twitter_card_description':
                $tag = array(
                    'title' => 'Twitter Card Description [twitter:description]',
                    'type'  => 'twitter:description',
                    'tag'   => '<meta name="twitter:description" content="{DESCRIPTION}" />'
                );
                break;

            case 'twitter_card_url':
                $tag = array(
                    'title' => 'Twitter Card URL [twitter:url]',
                    'type'  => 'twitter:url',
                    'tag'   => '<meta name="twitter:url" content="{URL}" />'
                );
                break;

            case 'twitter_card_image':
                $tag = array(
                    'title' => 'Twitter Card Image [twitter:image]',
                    'type'  => 'twitter:image',
                    'tag'   => '<meta name="twitter:image" content="{URL}" />'
                );
                break;

            case 'twitter_card_image_src':
                $tag = array(
                    'title' => 'Twitter Card Image SRC [twitter:image:src]',
                    'type'  => 'twitter:image:src',
                    'tag'   => '<meta name="twitter:image:src" content="{URL}" />'
                );
                break;

            // Dublin Core tags
            case 'dublincore_title':
                $tag = array(
                    'title' => 'Dublin Core Title [name=DC.title]',
                    'type'  => 'DC:title',
                    'tag'   => '<meta name="DC.title" content="{TITLE}" />'
                );
                break;

            case 'dublincore_description':
                $tag = array(
                    'title' => 'Dublin Core Description [name=DC.description]',
                    'type'  => 'DC:description',
                    'tag'   => '<meta name="DC.description" content="{DESCRIPTION}" />'
                );
                break;

            case 'dublincore_url':
                $tag = array(
                    'title' => 'Dublin Core Source [name=DC.source]',
                    'type'  => 'DC:source',
                    'tag'   => '<meta name="DC.source" content="{SOURCE}" />'
                );
                break;

            case 'dublincore_published_time':
                $tag = array(
                    'title' => 'Dublin Core Date [name=DC.date]',
                    'type'  => 'DC:date',
                    'tag'   => '<meta name="DC.date" scheme="W3CDTF" content="{DATE}" />'
                );
                break;

            case 'dublincore_modified_time':
                $tag = array(
                    'title' => 'Dublin Core Date Modified [name=DC.date.modified]',
                    'type'  => 'DC:date.modified',
                    'tag'   => '<meta name="DC.date.modified" scheme="W3CDTF" content="{DATE}" />'
                );
                break;

            default:
                break;
        }

        $this->bind($tag);

        return $this;
    }

    public function toArray()
    {
        return array(
            'title'   => $this->getTitle(),
            'type'    => $this->getType(),
            'tag'     => $this->getTag(),
            'content' => $this->getContent(),
            'output'  => $this->getOutput()
        );
    }
}
