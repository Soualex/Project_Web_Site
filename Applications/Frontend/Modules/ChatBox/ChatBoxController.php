<?php

namespace Applications\Frontend\Modules\ChatBox;

if (!defined('BASEPATH')) exit('No direct script access allowed');

class ChatBoxController extends \System\Library\BackController
{
	public function executeIndex(\System\Core\HTTPRequest $request)
	{
		$this->app()->page()->addVar('page_name', 'ChatBox');
		
		$this->app()->page()->addVar($this->app()->entities_handler()->load_entity_manager('ChatBox')->getList());
	}
}

?>