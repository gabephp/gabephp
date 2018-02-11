<?php

	namespace application\controllers;

	use core\Controller;
	use core\request\Request;
	use core\response\Response;

	class Errors extends Controller {

		public function error404() {
			global $gabephp;
			return new Response('<h1>Error 404</h1><br/>' . $gabephp->getConfiguration('statuscodes')['404']['message'], 404);
		}

	}
