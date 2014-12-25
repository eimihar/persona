<?php

class ControllerBlog
{
	public function __construct($exe)
	{
		$this->exe	= $exe;
		$this->view	= $exe->view;

		$this->layout = $exe->layout;
	}

	public function index()
	{
		$this->layout->set("title","Blogs");
		$data['articles']	= article\article::take(10)->get()->load("comment");
		$data['categories']	= article\category::all(null,["id","title"]);
		$data['url']	= $this->exe->url;
		return $this->layout->set("content",$this->view->create("blog/index")->set($data))->render();
	}

	public function categoryDelete($catId)
	{
		## delete only if there's no article
		$category = article\category::find($catId);

		if(!$category->hasArticle())
		{
			$this->exe->flash->set("success", "Category '".$category->title."' has been deleted.");
			$category->delete();
		}
		else
		{
			$this->exe->flash->set("error", "Unable to delete category '".$category->title."' with an existing article");
		}

		return $this->exe->redirect->to("default", ["controller"=>"blog", "action"=>"categoryAdd"]);
	}

	public function categoryUpdate($catId)
	{
		$category = article\category::find($catId);
		$data = array();

		if($input = $this->exe->request->post)
		{
			$rules	= ["_all"=>"required:This field is required."];

			if($error = $this->exe->validator->validate($input,$rules))
			{
				$this->exe->flash->set($error);
				$this->exe->form->flash();
				return $this->exe->redirect->flash('error', 'Something error but you don\'t know why.')->refresh();
			}

			$category->update($input);

			return $this->exe->redirect->flash('success', 'Category updated')->to('default', ["controller"=>'blog', 'action'=>'categoryAdd']);
		}

		$data['form'] = $this->exe->form->set($category->toArray());
		$this->layout->set("title", "Update Category");
		return $this->layout->set("content",$this->view->create("blog/categoryUpdate")->set($data))->render();
	}

	public function categoryAdd()
	{
		if($input = $this->exe->request->post)
		{
			$rules	= ["_all"=>"required:This field is required."];

			if($error = $this->exe->validator->validate($input,$rules))
			{
				$this->exe->flash->set($error);
				$this->exe->form->flash();
				return $this->exe->redirect->flash('error', 'Something error but you don\'t know why.')->refresh();
			}

			$category = new article\category($input);
			$category->save();

			return $this->exe->redirect->flash("success", "Added new category!")->refresh();
		}

		$this->layout->set("title","Category");
		$data['categories'] = article\category::all();
		$data['url'] = $this->exe->url;
		$data['form'] = $this->exe->form;
		return $this->layout->set("content",$this->view->create("blog/categoryAdd")->set($data))->render();
	}

	public function read(article\article $article)
	{
		$categories = article\category::all(null,['id', 'title']);

		$data = array();
		$data['article'] = $article;

		$data['category'] = $categories[$article->categoryId];
		$data['tags'] = $article->getTags();
		$data['references'] = $article->reference;
		$data['comments'] = $article->comment;

		$editLink = "<a href='".$this->exe->url->create("blog", ["id"=>$article->id, "action"=> "update"])."' class='fa fa-wrench'></a>";

		return $this->layout->set("title", $article->title." ".$editLink)
		->set("content", $this->view->create("blog/read")
		->set($data))->render();
	}

	public function update(article\article $article)
	{
		$this->exe->layout->data['assets']['css'][] = "tools/CLEditor/jquery.cleditor.css";
		$this->exe->layout->data['assets']['js'][] = "tools/CLEditor/jquery.cleditor.min.js";

		$data = array();

		$data['categories'] = article\category::all()->toList("id", "title");
		$data['flash'] = $this->exe->flash;
		$data['form'] = $this->exe->form->set($article->toArray())->set("tags", implode(", ",$article->getTags()->toList('name')));
		$data['references'] = $this->exe->flash->has("form_data.references") ? $this->exe->flash->get("form_data.references") : $article->reference->toList("value");

		if($input = $this->exe->request->post)
		{
			$rules = ['except:tags,references' => 'required:This field is required'];

			if($messages = $this->exe->validator->validate($input, $rules))
			{
				$this->exe->form->flash();
				return $this->exe->redirect->flash($messages)->flash('error', 'Ffing fields everywhere')->refresh();
			}

			## update.
			$tags = $input['tags'];
			$references = $input['references'];
			unset($input['tags']);
			unset($input['references']);
			$article->update($input);
			$article->addTag($tags, true);
			$article->addReference($references);

			return $this->exe->redirect->flash('success', 'Updated')->to("blog", ["id"=>$article->id, "action"=>"read"]);
		}

		return $this->layout->set('title', $article->title)
		->set("content", $this->view->create("blog/update")
		->set($data))->render();
	}

	public function delete(article\article $article)
	{
		$title = $article->title;
		$article->delete();
		$this->exe->flash->set("success", "Article '".$title."' has been deleted!");
		$this->exe->redirect->to("default", ["controller"=>"blog", "action"=>"index"]);
	}

	public function add()
	{
		$this->exe->layout->data['assets']['css'][] = "tools/CLEditor/jquery.cleditor.css";
		$this->exe->layout->data['assets']['js'][] = "tools/CLEditor/jquery.cleditor.min.js";

		if($input = $this->exe->request->post)
		{
			$rules = ['except:tags,references'=>'required:This field is required'];

			if($messages = $this->exe->validator->validate($input, $rules))
			{

				$this->exe->form->flash();
				return $this->exe->redirect->flash($messages)->flash('error','Empty fields everywhere.')->refresh();
			}

			// add new article.
			$tags = $input['tags'];
			$references = $input['references'];
			unset($input['tags']);
			unset($input['references']);

			$article = new Article($input);
			$article->save();

			## tag and references
			if($tags != "")
				$article->addTag($tags);
			if(count($references) > 0)
			{
				$article->addReference($references);
			}

			return $this->exe->redirect->flash('success','New article added.')->to("default",["controller"=>"blog", "action" => "index"]);
		}

		$data['form'] = $this->exe->form;
		$data['flash'] = $this->exe->flash;
		$data['categories'] = article\category::all(null,['id', 'title']);

		// prepare categories for select.

		$this->layout->set("title","New Article");
		return $this->layout->set("content", $this->view->create("blog/add")->set($data))->render();
	}
}