<?php
/**
 * Note resource model for notepad package tutorial.
 *
 * @package Bengine
 * @subpackage Notepad
 * @license http://opensource.org/licenses/gpl-license.php GNU Public License
 */

class Bengine_Notepad_Model_Resource_Note extends Recipe_Model_Resource_Abstract
{
	/**
	 * @return Bengine_Notepad_Model_Resource_Note
	 */
	protected function init()
	{
		$this->setMainTable("note");
		return parent::init();
	}
}