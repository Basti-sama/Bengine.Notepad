<?php
/**
 * Note model collection for notepad package tutorial.
 *
 * @package Bengine
 * @subpackage Notepad
 * @license http://opensource.org/licenses/gpl-license.php GNU Public License
 */

class Bengine_Notepad_Model_Collection_Note extends Recipe_Model_Collection_Abstract
{
	/**
	 * @param int $userId
	 * @return Bengine_Notepad_Model_Collection_Note
	 */
	public function addUserFilter($userId)
	{
		$this->getSelect()
			->where("user_id = ?", (int) $userId);
		return $this;
	}
}