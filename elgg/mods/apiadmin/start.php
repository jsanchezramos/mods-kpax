<?php
	/**
	 * Elgg API Admin
	 * 
	 * @package ElggAPIAdmin
	 * @license http://www.gnu.org/licenses/old-licenses/gpl-2.0.html GNU Public License version 2
	 * @author Curverider Ltd
	 * @copyright Curverider Ltd 2008-2010
	 * @link http://elgg.com/
	 */

	/**
	 * Initialise the API Admin tool
	 *
	 * @param unknown_type $event
	 * @param unknown_type $object_type
	 * @param unknown_type $object
	 */
	function apiadmin_init($event, $object_type, $object = null) {
		
		global $CONFIG;
		
		// Register a page handler, so we can have nice URLs
		elgg_register_page_handler('apiadmin','apiadmin_page_handler');
		
		// Register some actions
		//elgg_register_action("apiadmin/revokekey", false, $CONFIG->pluginspath . "apiadmin/actions/revokekey.php", true);
		//elgg_register_action("apiadmin/generate", false, $CONFIG->pluginspath . "apiadmin/actions/generate.php", true);
		elgg_register_action("apiadmin/revokekey", $CONFIG->pluginspath . "apiadmin/actions/revokekey.php", 'admin');
		elgg_register_action("apiadmin/generate", $CONFIG->pluginspath . "apiadmin/actions/generate.php", 'admin');
	}
	
	/**
	 * Page setup. Adds admin controls to the admin panel.
	 *
	 */
	function apiadmin_pagesetup()
	{
		if (get_context() == 'admin' && isadminloggedin()) {
			global $CONFIG;
			//add_submenu_item(elgg_echo('apiadmin'), $CONFIG->wwwroot . 'pg/apiadmin/');
			elgg_register_menu_item( 'page', 
						 array( 'name' => elgg_echo('apiadmin'), 
							'text' => elgg_echo('apiadmin'),
							'href' => $CONFIG->wwwroot . 'pg/apiadmin/',
							//'context' => elgg_get_context(),
							//'title' => 'tools',
							'section' => 'Tools',
							//'selected' => true,
							//'vars' => array('js' => "onclick=\"javascript:return confirm('" . elgg_echo('deleteconfirm') . "')\""),
						      )
						);
		}
	}
	
	
	function apiadmin_page_handler($page) 
	{
		global $CONFIG;
		
		if ($page[0])
		{
			switch ($page[0])
			{
  				case "generate":
 				  include($CONFIG->pluginspath . "apiadmin/actions/generate.php"); 
 				  break;
  				case "revokekey":
				  include($CONFIG->pluginspath . "apiadmin/actions/revokekey.php"); 
 				  break;
				default : //include($CONFIG->pluginspath . "apiadmin/index.php"); 
			}
		}
		
		include($CONFIG->pluginspath . "apiadmin/index.php"); 
	}
	
	function apiadmin_delete_key($event, $object_type, $object = null)
	{
		global $CONFIG;
		
		if (($object) && ($object->subtype === get_subtype_id('object', 'api_key')))
		{
			// Delete 
			return remove_api_user($CONFIG->site_id, $object->public);
		}
		
		return true;
	}
	
	
	// Make sure test_init is called on initialisation
	elgg_register_event_handler('init','system','apiadmin_init');
	elgg_register_event_handler('pagesetup','system','apiadmin_pagesetup');
	
	// Hook into delete to revoke secret keys
	elgg_register_event_handler('delete','object','apiadmin_delete_key');
?>