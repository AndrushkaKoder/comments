<?php

namespace Kernel\router;

use Kernel\Request\Request;
use Kernel\View\View;

class Router
{
	private $routes = [];
	private Request $request;
	private View $view;

	public function __construct(Request $request, View $view)
	{
		$this->initRoutes();

		$this->request = $request;
		$this->view = $view;
	}

	public function dispatch(string $uri, string $method): void
	{
		$route = $this->findRoute($uri, $method);

		if (!$route) notFound();

		if (is_array($route->getAction())) {
			[$controller, $action] = $route->getAction();
			$controller = new $controller();

			call_user_func([$controller, 'setView'], $this->view);
			call_user_func([$controller, 'setRequest'], $this->request);
			call_user_func([$controller, $action]);
		} else {
			call_user_func($route->getAction());
		}
	}

	private function initRoutes(): void
	{
		try {
			$routes = $this->getRoutes();
			if (!$routes) throw new \Exception('Маршруты не найдены!');
			foreach ($routes as $route) {
				/**
				 * @var Route $route
				 */
				$this->routes[$route->getMethod()][$route->getUri()] = $route;
			}
		} catch (\Exception $exception) {
			die($exception->getMessage());
		}
	}

	private function getRoutes()
	{
		return include_once ROUTES;
	}

	private function findRoute(string $uri, string $method): ?Route
	{
		if (!isset($this->routes[$method][$uri])) return null;

		return $this->routes[$method][$uri];
	}
}