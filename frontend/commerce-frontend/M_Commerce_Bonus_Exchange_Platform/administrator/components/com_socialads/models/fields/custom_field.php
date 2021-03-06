<?php
/**
 * @version     3.2
 * @package     com_socialads
 * @copyright   Copyright (c) 2009-2015 TechJoomla. All rights reserved
 * @license     GNU General Public License version 2, or later
 * @author      Techjoomla <extensions@techjoomla.com> - http://www.techjoomla.com
 */

defined('JPATH_BASE') or die;

jimport('joomla.html.html');
jimport('joomla.form.formfield');

/**
 * Supports an HTML select list of categories
 */
class JFormFieldCustom_field extends JFormField
{
	/**
	 * The form field type.
	 *
	 * @var		string
	 * @since	1.6
	 */
	protected $type = 'text';

	/**
	 * Method to get the field input markup.
	 *
	 * @return	string	The field input markup.
	 * @since	1.6
	 */
	protected function getInput()
	{
		// Initialize variables.
		$html = array();

		return implode($html);
	}
}