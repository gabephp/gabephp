<?php

	namespace core\request;

	use core\request\Input;
	use core\request\Server;

	class Request {

		/**
		 * @var Input
		 */
		protected $input;

		/**
		 * @return Input
		 */
		public function getInput(): Input {
			return $this->input;
		}

		/**
		 * @var Server
		 */
		protected $server;

		/**
		 * @return Server
		 */
		public function getServer(): Server {
			return $this->server;
		}

		/**
		 * @var array
		 */
		protected $parameters;

		/**
		 * @return array
		 */
		public function getParameters(): array {
			return $this->parameters;
		}

		/**
		 * @param array $parameters
		 *
		 * @return Request
		 */
		public function setParameters(array $parameters): Request {
			$this->parameters = $parameters;
			return $this;
		}

		/**
		 * @return string
		 */
		public function getUrl(): string {
			return $this->server->getScheme() . '://' . $this->server->getHostname() . $_SERVER['REQUEST_URI'];
		}

		/**
		 * @return string
		 */
		public function getRequestUrl(): string {
			return $_SERVER['REQUEST_URI'];
		}

		/**
		 * Request constructor.
		 *
		 * TODO: Complete request object.
		 */
		public function __construct() {
			$this->server = new Server();
		}

	}