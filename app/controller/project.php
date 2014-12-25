<?php
class ControllerProject
{
	public function __construct($exe)
	{
		$this->exe		= $exe;
		$this->layout	= $exe->layout;
	}

	public function index()
	{
		$data = array();

		$data['projects'] = project\project::all();
		$data['url'] = $this->exe->url;

		$this->layout->set("content",$this->exe->view->create("project/index")->set($data));
		return $this->layout->render();
	}

	public function view()
	{
		$data = array();

		$data['project'] = project\project::find($this->exe->param("project-title"));

		$this->layout->set("content",$this->exe->view->create("project/view")->set($data));
		return $this->layout->render();
	}
}