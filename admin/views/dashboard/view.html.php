<?php
/**
 * @package      ITPMeta
 * @subpackage   Component
 * @author       Todor Iliev
 * @copyright    Copyright (C) 2015 Todor Iliev <todor@itprism.com>. All rights reserved.
 * @license      http://www.gnu.org/copyleft/gpl.html GNU/GPL
 */

// no direct access
defined('_JEXEC') or die;

class ItpMetaViewDashboard extends JViewLegacy
{
    /**
     * @var JDocumentHtml
     */
    public $document;

    protected $domain;
    protected $latest;
    protected $urlsScripts;
    protected $totalUrls;
    protected $totalTags;
    protected $totalGlobalTags;

    protected $option;

    protected $version;
    protected $prismVersion;
    protected $prismVersionLowerMessage;

    protected $sidebar;

    public function __construct($config)
    {
        parent::__construct($config);
        $this->option = JFactory::getApplication()->input->get("option");
    }

    public function display($tpl = null)
    {
        $this->version = new Itpmeta\Version();

        // Load Prism library version
        if (!class_exists("Prism\\Version")) {
            $this->prismVersion = JText::_("COM_ITPMETA_ITPRISM_LIBRARY_DOWNLOAD");
        } else {
            $prismVersion       = new Prism\Version();
            $this->prismVersion = $prismVersion->getShortVersion();

            if (version_compare($this->prismVersion, $this->version->requiredPrismVersion, "<")) {
                $this->prismVersionLowerMessage = JText::_("COM_ITPMETA_PRISM_LIBRARY_LOWER_VERSION");
            }
        }

        $basic = new Itpmeta\Statistics\Basic(JFactory::getDbo());
        $this->totalUrls        = $basic->getTotalUrls();
        $this->totalTags        = $basic->getTotalTags();
        $this->totalGlobalTags  = $basic->getTotalGlobalTags();

        // Get latest items.
        jimport("itpmeta.statistics.urls.latest");
        $this->latest = new Itpmeta\Statistics\Urls\Latest(JFactory::getDbo());
        $this->latest->load();

        // Get urls with scripts.
        jimport("itpmeta.statistics.urls.scripts");
        $this->urlsScripts = new Itpmeta\Statistics\Urls\Scripts(JFactory::getDbo());
        $this->urlsScripts->load(array("limit" => 10));

        $uri = JUri::getInstance();
        $this->domain = $uri->toString(array("scheme", "host"));

        // Add submenu
        ItpMetaHelper::addSubmenu($this->getName());

        $this->addToolbar();
        $this->addSidebar();
        $this->setDocument();

        parent::display($tpl);
    }

    /**
     * Add the page title and toolbar.
     *
     * @since   1.6
     */
    protected function addToolbar()
    {
        JToolBarHelper::title(JText::_("COM_ITPMETA_DASHBOARD"));

        // Help button
        $bar = JToolBar::getInstance('toolbar');
        $bar->appendButton('Link', 'help', JText::_('JHELP'), JText::_('COM_ITPMETA_HELP_URL'));
    }

    /**
     * Add a menu on the sidebar of page
     */
    protected function addSidebar()
    {
        $this->sidebar = JHtmlSidebar::render();
    }

    /**
     * Method to set up the document properties
     *
     * @return void
     */
    protected function setDocument()
    {
        $this->document->setTitle(JText::_('COM_ITPMETA_DASHBOARD_ADMINISTRATION'));
    }
}
