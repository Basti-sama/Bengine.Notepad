<?php
/**
 * Note model for notepad package tutorial.
 *
 * @package Bengine
 * @subpackage Notepad
 * @license http://opensource.org/licenses/gpl-license.php GNU Public License
 */

class Bengine_Notepad_Model_Note extends Recipe_Model_Abstract
{
	/**
	 * @return Bengine_Notepad_Model_Note
	 */
	protected function init()
	{
		$this->setTableName("note");
		$this->setPrimaryKey("note_id");
		$this->setModelName("notepad/note");
		return parent::init();
	}

	/**
	 * @return Bengine_Notepad_Model_Note
	 */
	protected function _beforeSave()
	{
		if(!$this->getId())
		{
			$this->set("user_id", Core::getUser()->get("userid"));
			$this->set("time_created", TIME);
		}
		return parent::_beforeSave();
	}
}