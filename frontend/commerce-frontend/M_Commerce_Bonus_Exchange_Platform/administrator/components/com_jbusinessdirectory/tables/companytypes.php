<?php
/*------------------------------------------------------------------------
# JBusinessDirectory
# author CMSJunkie
# copyright Copyright (C) 2012 cmsjunkie.com. All Rights Reserved.
# @license - http://www.gnu.org/licenses/gpl-2.0.html GNU/GPL
# Websites: http://www.cmsjunkie.com
# Technical Support:  Forum - http://www.cmsjunkie.com/forum/j-businessdirectory/?p=1
-------------------------------------------------------------------------*/

defined('_JEXEC') or die('Restricted access');

class JTableCompanyTypes extends JTable {

	var $id				= null;	
	var $name			= null;

	/**
	 * Constructor
	 *
	 * @param object Database connector object
	 */
	function __construct(&$db) {
		parent::__construct('#__jbusinessdirectory_company_types', 'id', $db);
	}

	function setKey($k) {
		$this->_tbl_key = $k;
	}

	function getCompanyTypes() {
		$db =JFactory::getDBO();
		$query = "select * from #__jbusinessdirectory_company_types order by name";
		$db->setQuery($query);
		return $db->loadObjectList();
	}

	function getCompanyType($typeId) {
		$db = JFactory::getDBO();
		$query = "select * from #__jbusinessdirectory_company_types where id=$typeId";
		$db->setQuery($query);
		return $db->loadObject();
	}
}