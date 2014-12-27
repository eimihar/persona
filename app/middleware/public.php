<?php

class MiddlewarePublic
{
	public function handle($exe)
	{
		## eloquent. ;)
		$exe->eloquentCapsule	= new \App\Model\Eloquent\Eloquent("localhost", $exe->config->get('dbUser'), $exe->config->get('dbPass'), $exe->config->get('dbName'));

		## will basically base the route name on this, instead of the current parent route name.
		$exe->setRoutePrefix("public");
		$exe->url->setBase($exe->config->get('baseUrl'));
		$exe->url->setAsset($exe->config->get('assetUrl'));

		$exe->layout	= $exe->view->create("template/default")->setRequired('content');
		$exe->layout->set("url",$exe->url)->set("session",$exe->session);

		return $exe->next($exe);
	}
}