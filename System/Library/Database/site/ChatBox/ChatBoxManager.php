<?php

namespace System\Library\Database\Site\ChatBox;

if (!defined('BASEPATH')) exit('No direct script access allowed');
 
abstract ChatBoxManager extends \System\Library\Manager
{
	abstract public function messagesList($debut = -1, $limite = -1);
}

?>