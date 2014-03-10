<?php

/*
	CLASS: ChatBoxController
	PATH: Applications\Frontend\Modules\ChatBox
	DESCRIPTION: Script allowing to control the ChatBox.
	LAST UPDATE: 03/03/2014
	AUTHORS: Soulalex
*/

namespace Applications\Frontend\Modules\ChatBox;

if (!defined('BASEPATH')) exit('No direct script access allowed');

class ChatBoxController extends \System\Library\BackController
{
	public function executeIndex(\System\Core\HTTPRequest $request)
	{
		$this->app()->page()->addVar('page_name', 'ChatBox');
		$this->app()->page()->load_javascript('ChatBox');
		$this->app()->page()->load_css('chatbox');
		
		$messages = $this->app()->entities_handler()->load_model_manager('ChatBox')->messagesList();

		
	}
}

?>