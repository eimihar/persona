<?php
class ControllerMain
{
	public function __construct($exe)
	{
		$this->exe = $exe;
	}

	public function index()
	{
		$data['articles'] = article\article::take(10)->orderBy("created_at", "desc")->get();
		$data['projects'] = project\project::take(10)->orderBy("created_at", "desc")->get();
		$data['url'] = $this->exe->url;
		$this->exe->layout->set("title", "Dashboard");
		return $this->exe->layout->set("content",$this->exe->view->create("main/index")->set($data))->render();
	}

	public function error($code = null)
	{
		if(is_numeric($code))
		{

		}
		else
		{
			$msg = $code;
		}

		$this->exe->layout->set("title", "404 : Page not found");
		return $this->exe->layout->set("content",$this->exe->view->create("main/error")->set("msg", $msg))->render();
	}
}