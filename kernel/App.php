<?php

namespace kernel;

use Kernel\request\Request;
use Kernel\router\Router;
use Kernel\View\View;

final class App
{
	public function run()
	{
		$request = Request::createSelfFromGlobals();
		$view = new View();
		$router = new Router($request, $view);
		$router->dispatch($request->uri(), $request->httpMethod());
	}
}