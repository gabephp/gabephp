<?php

	namespace core;

	use Twig_Environment;
	use Twig_Loader_Filesystem;

	class Controller {

		/**
		 * @var Twig_Environment
		 */
		private $twig;

		/**
		 * Controller constructor.
		 */
		public function __construct() {
			global $gabephp;
			$config = $gabephp->getConfiguration('twig');
			if($gabephp->getConfiguration('general')['debug']) {
				array_push($config['environment'], array('debug'=>true));
			} else {
				error_reporting(0);
			}
			$this->twig = new Twig_Environment(new Twig_Loader_Filesystem($config['template-path']), $config['environment']);
		}

		/**
		 * @param string $fileName
		 * @param array $context
		 *
		 * @throws \Twig_Error_Loader
		 * @throws \Twig_Error_Runtime
		 * @throws \Twig_Error_Syntax
		 *
		 * @return string
		 */
		protected function render(string $fileName, array $context) {
			$template = $this->twig->load($fileName);
			return $template->render($this->extendContext($context));
		}

		/**
		 * @param array $context
		 *
		 * @return array
		 */
		private function extendContext(array $context) {
			global $gabephp;
			return array_merge($context, array(
				'version'=> VERSION,
				'elapsedTime'=>round(microtime(1) - $gabephp->getStartTime(), 4),
				'currentDate'=>array(
					'A'=>date('A'),
					'd'=>date('d'),
					'e'=>date('e'),
					'F'=>date('F'),
					'h'=>date('h'),
					'H'=>date('H'),
					'i'=>date('i'),
					'l'=>date('l'),
					'm'=>date('m'),
					's'=>date('s'),
					'W'=>date('W'),
					'Y'=>date('Y')
				)
			));
		}

	}