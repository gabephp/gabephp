<?php

	namespace core\request;

	class Server {

		/**
		 * @var string
		 */
		protected $hostname;

		/**
		 * @return string
		 */
		public function getHostname(): string {
			return $this->hostname;
		}

		/**
		 * @var integer
		 */
		protected $port;

		/**
		 * @return integer
		 */
		public function getPort(): int {
			return $this->port;
		}

		/**
		 * @var string
		 */
		protected $address;

		/**
		 * @return string
		 */
		public function getAddress(): string {
			return $this->address;
		}

		/**
		 * @var string
		 */
		protected $scheme;

		/**
		 * @return string
		 */
		public function getScheme(): string {
			return $this->scheme;
		}

		/**
		 * Server constructor.
		 */
		public function __construct() {
			$this->scheme = (!empty($_SERVER['HTTPS']) && $_SERVER['HTTPS'] !== 'off' || $_SERVER['SERVER_PORT'] == 443) ? Scheme::HTTPS : Scheme::HTTP;
			$this->hostname = $_SERVER['HTTP_HOST'];
			$this->port = $_SERVER['SERVER_PORT'];
			$this->address = $_SERVER['SERVER_ADDR'];
		}
	}