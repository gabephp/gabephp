<?php

	namespace core\routing;

	use core\collection\HashMap;
	use core\Configuration;
	use core\request\Request;
	use core\response\Response;

	class Router {

		/**
		 * @var \core\Configuration
		 */
		protected $configurationManager;

		/**
		 * The array containing the routes to be specified in the routes config file.
		 *
		 * @var \core\collection\HashMap
		 */
		protected $routes;

		/**
		 * The parameters from the matched route.
		 *
		 * @var array
		 */
		protected $parameters = [];

		/**
		 * Router constructor.
		 *
		 * @param \core\Configuration $configurationManager
		 *
		 * @throws \TypeError
		 */
		public function __construct(Configuration $configurationManager) {
			$this->configurationManager = $configurationManager;
			$this->routes               = new HashMap();
		}

		/**
		 * Tries to match the routes in routes.json with the current requested url and dispatches the corresponding controller and method if successful.
		 *
		 * @throws \ReflectionException
		 * @throws \TypeError
		 */
		public function handleRoute() {
			global $gabephp;
			$request    = $gabephp->getClassFactory()->get(Request::class);
			$urlMatched = false;
			foreach ($gabephp->getConfiguration('routes') as $regularExpression => $route) {
				if ($regularExpression != 'errors') {
					$this->routes->put($regularExpression, new Route($route['controller'], $route['method']));
					$parameters = [];
					if (preg_match('#' . $regularExpression . '#', strtok($_SERVER['REQUEST_URI'], '?'), $parameters)) {
						$urlMatched = true;
						foreach ($parameters as $key => $value) {
							if (is_int($key)) {
								unset($parameters[$key]);
							}
						}
						$request->setParameters($parameters);
						$this->dispatch($regularExpression);
						break;
					}
				}
			}
			if (!$urlMatched) {
				$error404Route = $gabephp->getConfiguration('routes')['errors']['404'];
				$this->routes->put('404', new Route($error404Route['controller'], $error404Route['method']));
				$this->dispatch('404');
			}
		}

		/**
		 * Dispatches the specified callable.
		 *
		 * @param string $url
		 *
		 * @throws \ReflectionException
		 * @throws \TypeError
		 */
		private function dispatch(string $url) {
			global $gabephp;
			if ($this->routes->hasKey($url)) {
				$route      = $this->routes->get($url);
				$controller = $gabephp->getClassFactory()->get($route->getController());
				$response   = $gabephp->getClassFactory()->invoke(get_class($controller), $route->getMethod());
				if (!is_a($response, Response::class)) {
					throw new \TypeError('`' . get_class($controller) . '->' . $route->getMethod() . '()` does not return a `' . Response::class . '` type object.');
				}
				$response->send();
			}
		}
	}