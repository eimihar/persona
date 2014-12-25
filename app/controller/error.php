<?php

class ControllerError
{
	public function __construct($exe)
	{
		$this->exe		= $exe;
		$this->layout	= $exe->layout;
		$this->view		= $exe->view;
	}

	public function general()
	{
		$data = array();

		if($message = $this->exe->param("message"))
			$data['message'] = $message;

		$this->layout->set("content",$this->view->create("error/general")->set("url",$this->exe->url)->set($data));
		return $this->layout->render();
	}
}