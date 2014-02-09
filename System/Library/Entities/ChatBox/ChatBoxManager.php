<?php

namespace System\Library\Entities\ChatBox;

if (!defined('BASEPATH')) exit('No direct script access allowed');
 
abstract ChatBoxManager extends \System\Library\Manager
{
	abstract public function messagesList($debut = -1, $limite = -1);
}

?>