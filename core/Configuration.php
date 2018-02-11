<?php

	namespace core;

	use core\parsers\YamlParser;

	class Configuration {

		/**
		 * @var array
		 */
		protected $configuration = array();

		/**
		 * @param string $name
		 *
		 * @return array
		 */
		public function getConfiguration(string $name): array {
			return $this->configuration[$name];
		}

		/**
		 * ConfigurationManager constructor.
		 *
		 * @throws \Exception
		 */
		public function __construct() {
			$this->loadConfiguration();
		}

		/**
		 * Loads all configuration files located in /application/configuration.
		 *
		 * @throws \Exception
		 */
		private function loadConfiguration() {
			$configurationDirectory = '../application/configuration/';
			$configurationFiles = scandir($configurationDirectory);
			foreach($configurationFiles as $configurationFile) {
				if(substr($configurationFile, -4) == '.yml') {
					$yamlParser = new YamlParser();
					$content = $yamlParser->loadFile($configurationDirectory . $configurationFile);
					$this->configuration[preg_replace('/.yml/', '', $configurationFile)] = $content;
				}
			}
		}
	}