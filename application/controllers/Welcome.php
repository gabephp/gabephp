<?php

	namespace application\controllers;

	use core\Controller;
	use core\request\Request;
	use core\response\Response;

	class Welcome extends Controller {

		public function index(Request $request) {
			global $gabephp;
			$context = array(
				'title'=>'Welcome!',
				'version'=> VERSION,
				'elapsedTime'=>round(microtime(1) - $gabephp->getStartTime(), 4)
			);
			return new Response($this->render('welcome.twig', $context));
		}

	}
