<?php

namespace System\Library\Models\ChatBox;

if (!defined('BASEPATH')) exit('No direct script access allowed');

abstract class ChatBoxManager extends \System\Library\Manager
{
	abstract public function messagesList($debut = -1, $limite = -1);
}

?>