<?php

	namespace core\routing;

	class Route {

		/**
		 * @var string
		 */
		protected $controller;

		/**
		 * @return string
		 */
		public function getController(): string {
			return $this->controller;
		}

		/**
		 * @var string
		 */
		protected $method;

		/**
		 * @return string
		 */
		public function getMethod(): string {
			return $this->method;
		}

		public function __construct(string $controller, string $method) {
			$this->controller = $controller;
			$this->method = $method;
		}

	}