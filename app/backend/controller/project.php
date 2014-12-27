<?php
class ControllerProject
{
	public function __construct($exe)
	{
		$this->exe		= $exe;
		$this->view		= $this->exe->view;
		$this->layout	= $this->exe->layout;
	}

	public function index()
	{
		$data['projects'] = project\project::all();
		$this->layout->set("title","Project");
		$this->layout->set("content",$this->view->create("project/index")->set("url", $this->exe->url)->set($data));
		return $this->layout->render();
	}

	public function add()
	{
		if($input = $this->exe->request->post)
		{
			$rules = ["except:date_start,date_end"=>"required:This is required."];

			if($error = $this->exe->validator->validate($input, $rules))
			{
				$this->exe->form->flash();
				return $this->exe->redirect->flash($error)->flash("error", "Are some souls supposed to be empty?")->refresh();
			}

			$project = new project\project($input);
			$project->save();

			return $this->exe->redirect->flash("success", "New project has been added.")->to("default",["controller"=>"project", "action"=>"index"]);
		}

		$this->layout->set("title", "New Project");
		return $this->layout->set("content", $this->view->create("project/add")->set("form", $this->exe->form))->render();
	}

	public function read(project\project $project)
	{
		$data = array();

		$data['project'] = $project;
		$this->layout->set("title",$project->name);
		$this->layout->set("content", $this->view->create("project/read")->set($data));
		return $this->layout->render();
	}

	public function update(project\project $project)
	{
		$data = array();

		if($input = $this->exe->request->post)
		{
			$rules = ["except:date_start,date_end"=>"required:This field is required."];

			if($error = $this->exe->validator->validate($input, $rules))
			{
				$this->exe->form->flash();
				return $this->exe->redirect->flash($error)->flash("error", "The darkness has come.")->refresh();
			}

			$project->update($input);

			return $this->exe->redirect->flash("success", "Successfully updated project '".$project->name."'")->refresh();
		}

		$this->exe->form->set($project->toArray());
		$data['form'] = $this->exe->form;

		$this->layout->set("title", "Update Project");
		$this->layout->set("content",$this->view->create("project/update")->set($data));
		return $this->layout->render();
	}

	public function delete(project\project $project)
	{
		$project->delete();

		return $this->exe->redirect->to("default", ["controller"=>"project", "action"=>"index"]);
	}
}