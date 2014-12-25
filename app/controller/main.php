<?php

class ControllerMain
{
	public function __construct($exe)
	{
		$this->exe		= $exe;
		$this->layout	= $exe->layout;
		$this->view		= $exe->view;
	}
	
	public function index()
	{
		$data = array();
		$data['url']	= $this->exe->url;
		$data['categories'] = article\category::take(3)->get();
		$this->layout->set("content",$this->view->create("main/index")->set($data));
		return $this->exe->layout->render();
	}

	public function about()
	{
		$data = array();
		
		$this->layout->set("content",$this->view->create("main/about")->set($data));
		return $this->exe->layout->render();
	}

	public function logout()
	{
		$this->exe->session->destroy("loggedin");
		
		return $this->exe->redirect->to("main.index");
	}

	public function login()
	{
		if($this->exe->session->has("loggedin"))
		{
			return $this->exe->redirect->to("@backend.default", ["controller" => "main", "action" => "index"]);
		}

		$data = array();

		if($input = $this->exe->request->post)
		{
			$rules = ['_all' => 'required:This field is required.'];

			if($error = $this->exe->validator->validate($input, $rules))
			{
				$this->exe->form->flash();
				return $this->exe->redirect->flash("login-error", "Everywhere, everywhere got bugs.")->refresh();
			}

			$username = "admin";
			$pass = "password";

			if($input['username'] != $username || $input['password'] != $pass)
			{
				$this->exe->form->flash();
				return $this->exe->redirect->flash("login-error", "Wrong! wrong answer!")->refresh();
			}

			$this->exe->session->set("loggedin",true);
			return $this->exe->redirect->refresh();
		}

		$this->layout->set("content",$this->view->create("main/login")->set($data)->set('exe', $this->exe));
		return $this->layout->render();
	}

	public function contact()
	{
		$data = array();
		$this->layout->set("content",$this->view->create("main/contact")->set($data));
		return $this->exe->layout->render();
	}
}