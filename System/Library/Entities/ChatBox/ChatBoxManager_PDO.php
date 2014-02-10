<?php

namespace System\Library\Entities\ChatBox;

if (!defined('BASEPATH')) exit('No direct script access allowed');
 
use \System\Library\Entities\ChatBox\ChatBox;
 
class ChatBoxManager_PDO extends ChatBoxManager
{
	public function messagesList($debut = -1, $limite = -1)
	{
		$sql = "SELECT * FROM chatbox_messages ORDER BY time DESC";

		if ($debut != -1 || $limite != -1) 
		{
			$sql .= ' LIMIT '.(int) $limite.' OFFSET '.(int) $debut;
		}

		$query = $this->dao->query($sql);
		$query->setFetchMode(\PDO::FETCH_CLASS | \PDO::FETCH_PROPS_LATE, '\System\Library\Database\Site\ChatBox\ChatBox');

		$listeNews = $query->fetchAll();
 
		$query->closeCursor();

		return $listeNews;
	}
}

?>