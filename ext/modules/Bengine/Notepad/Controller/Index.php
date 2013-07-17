<?php
/**
 * Index controller for notepad package tutorial.
 *
 * @package Bengine
 * @subpackage Notepad
 * @license http://opensource.org/licenses/gpl-license.php GNU Public License
 */

class Bengine_Notepad_Controller_Index extends Bengine_Game_Controller_Abstract
{
	/**
	 * @return Bengine_Notepad_Controller_Index
	 */
	protected function init()
	{
		Core::getLang()->load(array("Notepad"));
		return parent::init();
	}

	/**
	 * @return Bengine_Notepad_Controller_Index
	 */
	public function indexAction()
	{
		/* @var Bengine_Notepad_Model_Collection_Note $notes */
		$notes = Game::getCollection("notepad/note");
		$notes->addUserFilter(Core::getUser()->get("userid"));
		Core::getTemplate()->addLoop("notes", $notes->get());
		return $this;
	}

	/**
	 * @param int|array $id
	 * @return Bengine_Notepad_Controller_Index
	 */
	public function deleteAction($id = null)
	{
		if(empty($id) && $this->isPost())
		{
			$id = Core::getRequest()->getPOST("notes");
		}
		if(!empty($id))
		{
			$this->delete($id);
		}
		$this->redirect("game/".SID."/notepad.index");
		return $this;
	}

	/**
	 * @param int|array $ids
	 * @return Bengine_Notepad_Controller_Index
	 */
	protected function delete($ids)
	{
		if(!is_array($ids))
		{
			$ids = array($ids);
		}
		foreach($ids as $id)
		{
			Core::getQuery()->delete("note", "note_id = ? AND user_id = ?", null, null, array(
				$id, Core::getUser()->get("userid")
			));
		}
		return $this;
	}

	/**
	 * @return Bengine_Notepad_Controller_Index
	 */
	public function addAction()
	{
		/* @var Bengine_Notepad_Model_Note $note */
		$note = Game::getModel("notepad/note");
		if($this->isPost())
		{
			$success = $this->saveNote($note, $this->getParam("title"), $this->getParam("note_text"));
			if($success)
			{
				$note->resetData();
			}
		}
		$this->assign("note", $note);
		return $this;
	}

	/**
	 * @param int $id
	 * @return Bengine_Notepad_Controller_Index
	 */
	public function showAction($id)
	{
		$note = $this->loadNote($id);
		$this->assign("note", $note);
		return $this;
	}

	/**
	 * @param int $id
	 * @return Bengine_Notepad_Controller_Index
	 */
	public function editAction($id)
	{
		$note = $this->loadNote($id);
		if($this->isPost())
		{
			$this->saveNote($note, $this->getParam("title"), $this->getParam("note_text"));
		}
		$this->assign("note", $note);
		return $this;
	}

	/**
	 * @param int $id
	 * @return Bengine_Notepad_Model_Note
	 */
	protected function loadNote($id)
	{
		$note = Game::getModel("notepad/note")->load($id);
		if(!$note->get("note_id") || $note->get("user_id") != Core::getUser()->get("userid"))
		{
			Logger::dieMessage("NOTE_DOES_NOT_EXIST");
		}
		return $note;
	}

	/**
	 * @param Bengine_Notepad_Model_Note $note
	 * @param string $noteTitle
	 * @param string $noteText
	 * @return bool
	 */
	protected function saveNote(Bengine_Notepad_Model_Note $note, $noteTitle, $noteText)
	{
		$noteTitle = Str::validateXHTML($noteTitle);
		$noteText = richText($noteText);
		$noteTextLength = strlen(strip_tags($noteText));
		if(strlen($noteTitle) >= 3 && strlen($noteTitle) < 250 && $noteTextLength > 3 && $noteTextLength < 5000)
		{
			$note->set("title", $noteTitle);
			$note->set("note_text", $noteText);
			$note->save();
			Logger::addMessage("NOTE_SUCCESSFULLY_SAVED", "success");
			return true;
		}
		else
		{
			if(strlen($noteTitle) < 3 || strlen($noteTitle) >= 250)
			{
				$this->assign("titleError", Logger::getMessageField("NOTE_TITLE_INVALID"));
			}
			if($noteTextLength <= 3 || $noteTextLength >= 5000)
			{
				$this->assign("noteTextError", Logger::getMessageField("NOTE_TEXT_INVALID"));
			}
			return false;
		}
	}
}