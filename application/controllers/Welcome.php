<?php

	namespace application\controllers;

	use core\Controller;
	use core\request\Request;
	use core\response\Response;

	class Welcome extends Controller {

		public function index(Request $request) {
			$context = array(
				'title'=>'Welcome!'
			);
			return new Response($this->render('welcome.twig', $context));
		}

	}
