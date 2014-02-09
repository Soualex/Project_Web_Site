<?php

namespace System\Library\Database\Site\Ip_banned;

if (!defined('BASEPATH')) exit('No direct script access allowed');
 
use \System\Library\Database\Site\Routes\Ip_banned;
 
class Ip_bannedManager_PDO extends Ip_bannedManager
{
	public function get($ip) 
	{
		$query = $this->dao->prepare('SELECT ip, ban_date, unban_date, ban_reason, bannedby FROM ip_banned WHERE ip = :ip');
		$query->bindValue(':ip', $ip, \PDO::PARAM_INT);
		$query->execute();
		
		$query->setFetchMode(\PDO::FETCH_CLASS | \PDO::FETCH_PROPS_LATE, '\System\Library\Database\Site\Ip_banned\Ip_banned');
		$data = $query->fetch();

		return !empty($data) ? $data : NULL;
	}
}

?>