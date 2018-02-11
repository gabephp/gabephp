<?php

	namespace core;

	use core\routing\Router;

	class GabePHP {

		/**
		 * @var string
		 */
		protected $startTime;

		/**
		 * @return string
		 */
		public function getStartTime(): string {
			return $this->startTime;
		}

		/**
		 * @var \core\ClassFactory
		 */
		protected $classFactory;

		/**
		 * @return \core\ClassFactory
		 */
		public function getClassFactory(): \core\ClassFactory {
			return $this->classFactory;
		}

		/**
		 * @var \core\routing\Router
		 */
		protected $router;

		/**
		 * @var \core\Configuration
		 */
		protected $configuration;

		/**
		 * @param string $name
		 *
		 * @return array
		 */
		public function getConfiguration(string $name): array {
			return $this->configuration->getConfiguration($name);
		}

		/**
		 * UnpleasantFramework constructor.
		 *
		 * @throws \ReflectionException
		 * @throws \TypeError
		 */
		public function __construct() {
			$this->startTime = microtime(1);
			$this->classFactory = new ClassFactory();
			$this->configuration = $this->classFactory->get(Configuration::class);
			$this->router = $this->classFactory->get(Router::class);
		}

		/**
		 * @throws \ReflectionException
		 * @throws \TypeError
		 */
		public function initialize() {
			$this->router->handleRoute();
		}
	}