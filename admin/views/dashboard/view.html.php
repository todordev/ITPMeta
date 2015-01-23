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
    protected $itprismVersion;

    protected $sidebar;

    public function __construct($config)
    {
        parent::__construct($config);
        $this->option = JFactory::getApplication()->input->get("option");
    }

    public function display($tpl = null)
    {
        // Load ITPrism library version
        jimport("itprism.version");
        if (!class_exists("ITPrismVersion")) {
            $this->itprismVersion = JText::_("COM_ITPMETA_ITPRISM_LIBRARY_DOWNLOAD");
        } else {
            $itprismVersion       = new ITPrismVersion();
            $this->itprismVersion = $itprismVersion->getShortVersion();
        }

        jimport("itpmeta.statistics.basic");
        $basic = new ITPMetaStatisticsBasic(JFactory::getDbo());
        $this->totalUrls        = $basic->getTotalUrls();
        $this->totalTags        = $basic->getTotalTags();
        $this->totalGlobalTags  = $basic->getTotalGlobalTags();

        // Get latest items.
        jimport("itpmeta.statistics.urls.latest");
        $this->latest = new ITPMetaStatisticsUrlsLatest(JFactory::getDbo());
        $this->latest->load(5);

        // Get urls with scripts.
        jimport("itpmeta.statistics.urls.scripts");
        $this->urlsScripts = new ITPMetaStatisticsUrlsScripts(JFactory::getDbo());
        $this->urlsScripts->load(10);

        $uri = JUri::getInstance();
        $this->domain = $uri->toString(array("scheme", "host"));

        $this->version = new ItpMetaVersion();

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
