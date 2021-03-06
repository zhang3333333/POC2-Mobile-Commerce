<?php
/**
 * @package Freestyle Joomla
 * @author Freestyle Joomla
 * @copyright (C) 2013 Freestyle Joomla
 * @license GNU/GPLv3 http://www.gnu.org/licenses/gpl-3.0.html
**/

namespace SBBCodeParser;
defined('_JEXEC') or die;

class Node_Text extends Node
{
	protected $text;


	public function __construct($text)
	{
		$this->text = $text;
	}

	public function get_html($nl2br=true)
	{
		if(!$nl2br)
			return str_replace("  ", " &nbsp;", htmlentities($this->text, ENT_QUOTES | ENT_IGNORE, "UTF-8"));

		return str_replace("  ", " &nbsp;", nl2br(htmlentities($this->text, ENT_QUOTES | ENT_IGNORE, "UTF-8")));
	}

	public function get_text()
	{
		return $this->text;
	}
}