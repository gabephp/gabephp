<?php

	define('VERSION', '0.0.1');

	spl_autoload_register(function ($class) {
		$root = dirname(__DIR__);
		$file = '/' . str_replace('\\', '/', $class) . '.php';
		if (is_readable($root . $file)) {
			require_once($root . $file);
		}
	});

	require_once(__DIR__ . '/../vendor/autoload.php');

	global $gabephp;
	$gabephp = new \core\GabePHP();
	$gabephp->initialize();

	/*
	 * TODO: Implement Doctrine.
	 */