<?php
require_once "../exedra/Exedra/Exedra.php";
require_once "vendor/autoload.php";
error_reporting(E_ALL);
$exedra	= new \Exedra\Exedra(__DIR__);
$app = $exedra->build("app",function($app)
{
	$app->setExecutionFailRoute("general-error");

	## register eloquent entities;
	$app->getExedra()->registerAutoload("App/Model/Entities");

	$config = json_decode(file_get_contents("env_config"), true);

	$app->map->addRoute(Array(
		"general-error"=>Array("any","error",function($exe)
		{
			$exe->response->setStatus(404);
			$message	= "Unable to complete request.";

			if($msg = $exe->param('message'))
			{
				$message .= "<br>".$msg;
			}

			if($exe->param('exception'))
			{
				$implode = function($arr)
				{
					if(!$arr)
						return "null";

					foreach($arr as $k=>$v)
						$val[] = "$k : $v";

					return implode(", ",$val);
				};

				$message .= "<br>";
				/*if($exe->param('exception')->getRoute())
				{
					$message .= "Exception at [".$exe->param('exception')->getRoute()."]<br>";
					$message .= "Route parameter(s) : ".$implode($exe->param('exception')->getParams())."<br>";
				}*/
				$message .= "Message : ".$exe->param('exception')->getMessage();
			}

			return $exe->execute("@public.error", ["message"=>$message]);
		}),
		"backend"=>[
			"config"=>$config,
			"uri"=>"dashboard",
			"subapp"=>"backend",
			"bind:middleware"=>function($exe){
			## not logged in.
			if(!$exe->session->has("loggedin"))
				return $exe->execute("@general-error", ["message"=>"Trying to execute some known route? well, check the routing out! ;)"]);

			## eloquent. ;)
			$exe->eloquentCapsule	= new \App\Model\Eloquent\Eloquent("localhost", $exe->config->get('dbUser'), $exe->config->get('dbPass'), $exe->config->get('dbName'));
			
			$exe->setRoutePrefix("backend");

			$exe->url->setBase($exe->config->get('baseUrl'));
			$exe->url->setAsset($exe->config->get('assetUrl'));
			$exe->view->setDefaultData("exe", $exe);

			$exe->layout	= $exe->view->create("template/default")->setRequired("content,title");
			$exe->layout->set(["exe"=>$exe]);

			return $exe->next($exe);
		},"subroute"=>[
			"blog"		=> ["uri"=>"blog/[i:id]/[:action]","execute"=>function($exe)
			{
				## get article here ;)
				$article = article\article::find($exe->param("id"));

				return $exe->controller->execute(["blog",[$exe]],$exe->param("action"), [$article]);
			}],
			"project"	=>["uri"=>"project/[i:id]/[:action]","execute"=>function($exe)
			{
				$project = project\project::find($exe->param("id"));

				return $exe->controller->execute(["project",[$exe]],$exe->param("action"), [$project]);
			}],
			"error" => ["uri"=>false, "execute"=>"controller=main@error"],
			"default"	=> ["uri"=>"[:controller]/[**:action]","execute"=>"controller={controller}@{action}"],
			]],
		"public"=>["config"=>$config,"bind:middleware"=>"middleware=public","subroute"=>[
			"error"	=>["uri"=>"404","execute"=>"controller=error@general"],
			"project"	=>["uri"=>"project","subroute"=>[
				"index"	=>["uri"=>"","execute"=>"controller=project@index"],
				"view"	=>["uri" =>"[:project-title]", "execute"=>"controller=project@view"],
				]],
			"main"			=>["subroute"=>[
				"index"		=>["uri"=>"","execute"=>"controller=main@index"],
				"about"	=>["uri"=>"about","execute"=>"controller=main@about"],
				"login"		=>["uri"=>"login", "execute"=> "controller=main@login"],
				"logout"	=>["uri"=>"logout", "execute"=> "controller=main@logout"]
				]],
			"blog"=>["uri"=>"blog","subroute"=>[
				"index"		=>["uri"=>"","execute"=>"controller=blog@index"],
				"view"		=>["uri"=>"[:blog-title]","execute"=>"controller=blog@view"],
				"facade"	=>["uri"=>"[:id]/[:blog-actual-title]", "execute"=> "controller=blog@facadeView"]
				]],
			"your-way"=>["uri"=>"give-up", "execute"=>function($exe)
				{
					$exe->redirect->toUrl("https://www.google.com.my/search?espv=2&q=purse+yours%2C+and+i+will+pursue+mine%2C+hopefully+we%27ll+meet+one+day%2C+at+the+crossroad+of+life&oq=purse+yours%2C+and+i+will+pursue+mine%2C+hopefully+we%27ll+meet+one+day%2C+at+the+crossroad+of+life&gs_l=serp.3...4295.4295.0.9146.1.1.0.0.0.0.146.146.0j1.1.0.msedr...0...1c.1.60.serp..1.0.0.NeC6OC8lwPI");
				}]
			]],
		));

		$app->map->addRoute(["test"=>["uri"=>"test","execute"=>function(){return "hello-world";}]]);
});

## if accessed by console, pass this argument to another apps, and execute.
if(isset($argv))
{
	$eloquent	= new \App\Model\Eloquent\Eloquent;
	$eloquentCapsule	= $eloquent->setup();
	$exedra->load("console",["argv"=>$argv])->execute("console",[
		"command"=>$argv,
		"schemaBuilder"=>[
			"schema"=>$app->loader->load("documents:schema.php"),
			"connection"=>$eloquentCapsule->getConnection("default")]
		]);
}
else
{

	$exedra->dispatch();
}

?>