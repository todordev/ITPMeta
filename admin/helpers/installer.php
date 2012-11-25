<?php
/**
 * @package      ITPrism Components
 * @subpackage   ITPMeta
 * @author       Todor Iliev
 * @copyright    Copyright (C) 2010 Todor Iliev <todor@itprism.com>. All rights reserved.
 * @license      http://www.gnu.org/copyleft/gpl.html GNU/GPL
 * ITPMeta is free software. This version may have been modified pursuant
 * to the GNU General Public License, and as distributed it includes or
 * is derivative of works licensed under the GNU General Public License or
 * other free or open source software licenses.
 */

/**
 * These class contains methods using for upgrading of the extensions
 *
 */
class ItpMetaInstallHelper {
	
    public static function startTable() {
        echo '
        <div style="width: 600px;">
        <table class="table table-bordered">';
    }
    
    public static function endTable() {
        echo "</table></div>";
    }
    
	/**
	 * Display an HTML code for a row
	 * 
	 * @param string $title
	 * @param array $result 
	 * array(
	 * 	type => success, important, warning,
	 * 	text => yes, no, off, on, warning,...
	 * )
	 */
	public static function addRow($title, $result, $info) {
	    
	    $outputType = JArrayHelper::getValue($result, "type", "");
	    $outputText = JArrayHelper::getValue($result, "text", "");
	    
	    $output     = "";
	    if(!empty($outputType) AND !empty($outputText)) {
            $output = '<span class="label label-'.$outputType.'">'.$outputText.'</span>';	        
	    }
	        
	    echo '
	    <tr>
            <td>'.$title.'</td>
            <td>'.$output.'</td>
            <td>'.$info.'</td>
        </tr>';
	}
	
    public static function isTableExist($table){
        
        $db     = JFactory::getDbo();
        
        // Check for existing tables
        $config = JFactory::getConfig();;
        $tablePrefix = $config->get("dbprefix");
        
        // tmp_#__itpm_global_tags
        $table  = str_replace("#__", $tablePrefix, $table);
        $db->setQuery("SHOW TABLES LIKE '".$table."'");
        $result = $db->loadResult();
        
        return (bool)$result;
        
    }
    
    public static function disableForignerKeys() {
        $db     = JFactory::getDbo();
        $db->setQuery("SET FOREIGN_KEY_CHECKS=0");
        $db->query();
    }
    
    public static function enableForignerKeys() {
        $db     = JFactory::getDbo();
        $db->setQuery("SET FOREIGN_KEY_CHECKS=1");
        $db->query();
    }
   
    public static function importGlobalTags() {
        $db     = JFactory::getDbo();
        
        $query = "TRUNCATE TABLE `#__itpm_global_tags`";
        $db->setQuery($query);
        $db->query();
    
        $query = "INSERT INTO `#__itpm_global_tags` (`id`, `title`, `tag`, `content`, `output`, `published`) SELECT `id`, `title`, `tag`, `content`, `output`, `published` FROM `tmp_#__itpm_global_tags`";
        $db->setQuery($query);
        $db->query();
        
        $query = "DROP TABLE IF EXISTS `tmp_previous_#__itpm_global_tags`";
        $db->setQuery($query);
        $db->query();
        
        $query = "RENAME TABLE `tmp_#__itpm_global_tags` TO `tmp_previous_#__itpm_global_tags`";
        $db->setQuery($query);
        $db->query();
    }
    
    public static function importURLsAndTags() {
        
        $db     = JFactory::getDbo();
        
        // Truncate current tables
        $query = "TRUNCATE TABLE `#__itpm_tags`";
        $db->setQuery($query);
        $db->query();
        
        $query = "TRUNCATE TABLE `#__itpm_urls`";
        $db->setQuery($query);
        $db->query();
    
        // Import values from TMP tables
        $query = "INSERT INTO `#__itpm_urls` (`id`, `uri`, `published`) SELECT `id`, `uri`, `published` FROM `tmp_#__itpm_urls`";
        $db->setQuery($query);
        $db->query();
        
        $query = "INSERT INTO `#__itpm_tags` (`id`, `title`, `tag`, `content`, `output`, `url_id`) SELECT `id`, `title`, `tag`, `content`, `output`, `url_id` FROM `tmp_#__itpm_tags`";
        $db->setQuery($query);
        $db->query();
        
        // Rename TMP tables
        $query = "DROP TABLE IF EXISTS `tmp_previous_#__itpm_urls`";
        $db->setQuery($query);
        $db->query();
        
        $query = "RENAME TABLE `tmp_#__itpm_urls` TO `tmp_previous_#__itpm_urls`";
        $db->setQuery($query);
        $db->query();
        
        $query = "DROP TABLE IF EXISTS `tmp_previous_#__itpm_tags`";
        $db->setQuery($query);
        $db->query();
        
        $query = "RENAME TABLE `tmp_#__itpm_tags` TO `tmp_previous_#__itpm_tags`";
        $db->setQuery($query);
        $db->query();
    }
    
    
}