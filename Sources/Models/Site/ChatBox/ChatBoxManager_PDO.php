<?php

namespace System\Library\Models\ChatBox;

if (!defined('BASEPATH')) exit('No direct script access allowed');

use \System\Library\Models\ChatBox\ChatBox_message;

class ChatBoxManager_PDO extends ChatBoxManager
{
	public function messagesList($debut = -1, $limite = -1)
	{
		$sql = "SELECT C.id, A.username, C.time, C.content FROM chatbox_messages C INNER JOIN account A ON C.user_id = A.id ORDER BY time DESC";

		if ($debut != -1 || $limite != -1) 
		{
			$sql .= ' LIMIT '.(int) $limite.' OFFSET '.(int) $debut;
		}

		$query = $this->dao('Site')->query($sql);
		$query->setFetchMode(\PDO::FETCH_CLASS | \PDO::FETCH_PROPS_LATE, '\System\Library\Models\ChatBox\ChatBox_message');

		$listeNews = $query->fetchAll();
 
		$query->closeCursor();

		return $listeNews;
	}
}

?>