<?php

namespace Framework\Controller;

use Framework\Library\Controller;

class Example extends Controller
{
	
	public function indexAction()
	{
		$this->render("index",array("hello"=>"Welcome message"));
	}
}
