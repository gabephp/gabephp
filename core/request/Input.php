<?php

	namespace core\request;

	class Input {

		/**
		 * Allows $_GET, $_POST, $_COOKIE, $_FILES arrays.
		 *
		 * If set to false, $_GET, $_POST, $_COOKIE and $_FILES will be set to an empty array after retrieval of data.
		 *
		 * @var bool
		 */
		protected $allowInputArrays = false;

		/**
		 * An array of all HTTP request headers.
		 *
		 * @var array
		 */
		protected $headers = array();
	}