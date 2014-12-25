<?php
class ControllerBlog
{
	public function __construct($exe)
	{
		$this->exe		= $exe;
		$this->layout	= $this->exe->layout;
		$this->view		= $this->exe->view;
	}

	public function index()
	{
		$data = array();
		$data['articles'] = article\article::take(10)->get();
		$data['url'] = $this->exe->url;

		$this->layout->set("content",$this->view->create("blog/index")->set($data));
		return $this->exe->layout->render();
	}

	public function view()
	{
		## get list of blog.
		$id	= $this->exe->param('blog-title');
		$data['article'] = $article = article\article::find($id);
		$data['references'] = $article->reference;
		$data['comments'] = $article->comment;
		$data['form'] = $this->exe->form;
		$data['flash'] = $this->exe->flash;

		if($input = $this->exe->request->post)
		{
			$rules = ["_all"=>"required:Required"];

			if($error = $this->exe->validator->validate($input, $rules))
			{
				$this->exe->form->flash();
				return $this->exe->redirect->flash("error-comment", "Please properly fill the comment form.")->refresh();
			}

			$article->addComment($input['userName'], $input['userEmail'], $input['commentBody']);

			return $this->exe->redirect->refresh();
		}

		$this->layout->set("content",$this->view->create("blog/view")->set($data));
		return $this->exe->layout->render();	
	}


}