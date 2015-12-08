<?php
/**
 * @package      ITPMeta
 * @subpackage   Plugins
 * @author       Todor Iliev
 * @copyright    Copyright (C) 2015 Todor Iliev <todor@itprism.com>. All rights reserved.
 * @license      http://www.gnu.org/copyleft/gpl.html GNU/GPL
 */

// no direct access
defined('_JEXEC') or die;

jimport('Prism.init');
jimport('Itpmeta.init');

/**
 * This plugin puts tags to the page code.
 *
 * @package        ITPMeta
 * @subpackage     Plugins
 */
class plgSystemItpMeta extends JPlugin
{
    /**
     * @var JApplicationSite
     */
    protected $app;
    
    /**
     * These are tags that won't be overridden.
     *
     * @var array
     */
    private $notOverridden = array('google_alternate');

    /**
     * Get clean URI.
     *
     * @return string
     */
    protected function getUri()
    {
        $filter    = JFilterInput::getInstance();

        $uri       = Itpmeta\Url\UrlHelper::getUri();
        $uriString = $uri->toString(array('path', 'query'));
        $uriString = $filter->clean($uriString);

        // Load tags for current address
        $itpUri = Itpmeta\Url\Uri::getInstance(JFactory::getDbo(), array('uri' => $uriString));
        $itpUri->setNotOverridden($this->notOverridden);

        return $itpUri;

    }

    private function isRestricted()
    {
        if ($this->app->isAdmin()) {
            return true;
        }

        $document = JFactory::getDocument();
        /** @var $document JDocumentHTML */

        $type = $document->getType();
        if (strcmp('html', $type) !== 0) {
            return true;
        }

        // It works only for GET request
        $method = $this->app->input->getMethod();
        if (strcmp('GET', $method) !== 0) {
            return true;
        }

        // Check component enabled
        if (!JComponentHelper::isEnabled('com_itpmeta')) {
            return true;
        }

        return false;
    }

    /**
     * Put tags into the HEAD tag.
     */
    public function onBeforeCompileHead()
    {
        // Check for restrictions
        if ($this->isRestricted()) {
            return;
        }

        // If user want to put tags after the <head> tag
        // leave from this method. It is the method that puts tags to the head no.
        if ($this->params->get('tags_position', 0)) {
            return;
        }

        // Get current URI and load tags for current address.
        $itpUri = $this->getUri();
        /** @var $itpUri Itpmeta\Url\Uri */

        $tags = $itpUri->getTags();

        // Add metadata
        if (count($tags) > 0) {

            $document = JFactory::getDocument();
            /** @var $document JDocumentHTML */

            foreach ($tags as $tag) {
                $tag->output = JString::trim($tag->output);
                if ($tag->output !== '') {
                    $document->addCustomTag($tag->output);
                }
            }
        }

    }

    /**
     * Put some additional code - namespaces,
     * additional code after body tag or before closing body tag.
     */
    public function onAfterRender()
    {
        // Check for restrictions
        if ($this->isRestricted()) {
            return;
        }

        // Get document buffer
        $buffer = $this->app->getBody();

        switch ($this->params->get('tags_position', 0)) {
            case 1:
                $buffer = $this->putAfterHead($buffer);
                break;
            case 2:
                $buffer = $this->putAfterTitle($buffer);
                break;
        }

        // Put open graph namespace in the HTML element
        $buffer = $this->putNamespaces($buffer, $this->params);

        // Add code after body tag and before closing body tag
        $buffer = $this->putAdditionalCode($buffer);

        $this->app->setBody($buffer);
    }

    /**
     * Put tags after opening HEAD tag.
     *
     * @param string $buffer
     *
     * @return string
     */
    private function putAfterHead($buffer)
    {
        // Get current URI and load tags for current address.
        $itpUri = $this->getUri();
        /** @var $itpUri Itpmeta\Url\Uri */

        $tags = $itpUri->getTags();

        if (count($tags) === 0) {
            return $buffer;
        }

        // Add metadata
        if (count($tags) > 0) {
            $output = '';
            $items  = array();
            foreach ($tags as $tag) {
                if ($tag->output !== '') {
                    $items[] = JString::trim($tag->output);
                }
            }

            if (count($items) > 0) {
                $output = implode("\n", $items);
            }
            $matches = array();
            if (preg_match('/(<head.*?>)/i', $buffer, $matches)) {
                $afterHead = $matches[0] . "\n" . $output;
                $buffer    = str_replace($matches[0], $afterHead, $buffer);
            }
        }

        return $buffer;
    }

    /**
     * Put tags after tag TITLE.
     *
     * @param string $buffer
     *
     * @return string
     */
    private function putAfterTitle($buffer)
    {
        // Get current URI and load tags for current address.
        $itpUri = $this->getUri();
        /** @var $itpUri Itpmeta\Url\Uri */

        $tags = $itpUri->getTags();

        if (!$tags) {
            return $buffer;
        }

        // Add metadata
        if (count($tags) > 0) {
            $output = "</title>\n";
            $items  = array();
            foreach ($tags as $tag) {
                if ($tag->output !== '') {
                    $items[] = JString::trim($tag->output);
                }
            }

            if (count($items) > 0) {
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
     * 
     * @return string
     */
    private function putAdditionalCode($buffer)
    {
        // Get current URI and load tags for current address.
        $itpUri = $this->getUri();
        /** @var $itpUri Itpmeta\Url\Uri */

        // If the URI does not exist or not published
        // we don't change the buffer
        if (!$itpUri->getId() or !$itpUri->isPublished()) {
            return $buffer;
        }

        // After BODY tag.
        $script = $itpUri->getScript('after');
        if ($script !== '') {
            $matches = array();
            if (preg_match('/(<body.*?>)/i', $buffer, $matches)) {
                $afterBody = $matches[0] . "\n" . $script;
                $buffer    = str_replace($matches[0], $afterBody, $buffer);
            }
        }

        // Before BODY tag.
        $script = $itpUri->getScript('before');
        if ($script !== '') {
            $beforeBody = "\n" . $script . "\n</body>";
            $buffer     = str_replace('</body>', $beforeBody, $buffer);
        }

        return $buffer;
    }

    /**
     * Generate and put namespace schemes to the HTML tag
     *
     * @param string    $buffer Output buffer
     * @param Joomla\Registry\Registry $params Component parameters
     *                          
     * @return string
     */
    private function putNamespaces($buffer, $params)
    {
        $prefixes = array();

        // OpenGraph namespace
        if ($params->get('opengraph_scheme', 0)) {
            $prefixes[] = 'og: http://ogp.me/ns#';
        }

        // Facebook namespace
        if ($params->get('facebook_scheme', 0)) {
            $prefixes[] = 'fb: http://ogp.me/ns/fb#';
        }

        // OpenGraph article namespace
        if ($params->get('opengraph_article_scheme', 0)) {
            $prefixes[] = 'article: http://ogp.me/ns/article#';
        }

        // OpenGraph blog namespace
        if ($params->get('opengraph_blog_scheme', 0)) {
            $prefixes[] = 'blog: http://ogp.me/ns/blog#';
        }

        // OpenGraph blog namespace
        if ($params->get('opengraph_business_scheme', 0)) {
            $prefixes[] = 'business: http://ogp.me/ns/business#';
        }

        // OpenGraph blog namespace
        if ($params->get('opengraph_product_scheme', 0)) {
            $prefixes[] = 'product: http://ogp.me/ns/product#';
        }

        // OpenGraph book namespace
        if ($params->get('opengraph_book_scheme', 0)) {
            $prefixes[] = 'books: http://ogp.me/ns/books#';
        }

        // OpenGraph profile namespace
        if ($params->get('opengraph_profile_scheme', 0)) {
            $prefixes[] = 'profile: http://ogp.me/ns/profile#';
        }

        // OpenGraph video namespace
        if ($params->get('opengraph_video_scheme', 0)) {
            $prefixes[] = 'video: http://ogp.me/ns/video#';
        }

        // OpenGraph website namespace
        if ($params->get('opengraph_website_scheme', 0)) {
            $prefixes[] = 'website: http://ogp.me/ns/website#';
        }

        // OpenGraph music namespace
        if ($params->get('opengraph_music_scheme', 0)) {
            $prefixes[] = 'music: http://ogp.me/ns/music#';
        }

        if (count($prefixes) > 0) {
            $string = 'prefix="{STRING}"';
            $prefix = implode(' ', $prefixes);
            $string = str_replace('{STRING}', $prefix, $string);
            $newHtmlAttr = '<html ' . $string;
            $buffer      = str_replace('<html', $newHtmlAttr, $buffer);
        }

        return $buffer;
    }
}
