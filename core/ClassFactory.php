<?php

	namespace core;

	use core\collection\HashMap;
	use core\request\Request;

	/**
	 * This class keeps a record of all class instances and makes sure that no new instances are being created if not necessary.
	 *
	 * Class ClassFactory
	 *
	 * @package core
	 */
	class ClassFactory {

		/**
		 * The collection of instances.
		 *
		 * @var \core\collection\HashMap
		 */
		protected $instances;

		/**
		 * ClassFactory constructor.
		 */
		public function __construct() {
			global $gabephp;
			$this->instances = new HashMap();
			$this->instances->put(get_class($gabephp), $gabephp);
			$this->instances->put(get_class($this), $this);
		}

		/**
		 * Checks if an instance of a class already exists. If not, it will instantiate the class and return. If so, it will return the existing instance.
		 *
		 * @param string $className
		 *
		 * @return mixed|object
		 * @throws \ReflectionException
		 */
		public function get(string $className) {
			if($this->instances->hasKey($className)) {
				return $this->instances->get($className);
			}
			$reflectionClass = new \ReflectionClass($className);
			if ($reflectionClass->hasMethod('__construct')) {
				$constructorDependencies = $this->getMethodDependencies($reflectionClass->getConstructor());
				$instance = $reflectionClass->newInstanceArgs($constructorDependencies);
			}
			else {
				$instance = $reflectionClass->newInstance();
			}
			$this->instances->put($className, $instance);
			return $instance;
		}

		/**
		 * Dispatches a class method.
		 *
		 * @param string $className
		 * @param string $methodName
		 *
		 * @return mixed
		 * @throws \ReflectionException
		 */
		public function invoke(string $className, string $methodName) {
			$instance = $this->get($className);
			$reflectionObject = new \ReflectionObject($instance);
			$reflectionMethod = $reflectionObject->getMethod($methodName);
			if($reflectionMethod->getParameters()) {
				$methodDependencies = $this->getMethodDependencies($reflectionMethod);
				return $reflectionObject->getMethod($methodName)->invokeArgs($instance, $methodDependencies);
			}
			return $reflectionObject->getMethod($methodName)->invoke($instance);
		}

		/**
		 * Returns an array of all the method's dependencies from a ReflectionMethod object.
		 *
		 * @param \ReflectionMethod $method
		 *
		 * @return array
		 * @throws \ReflectionException
		 */
		private function getMethodDependencies(\ReflectionMethod $method) {
			$parameters   = $method->getParameters();
			$dependencies = array();
			foreach ($parameters as $parameter) {
				if($this->instances->hasKey($parameter->getClass()->name)) {
					array_push($dependencies, $this->instances->get($parameter->getClass()->name));
					continue;
				}
				array_push($dependencies, $this->get($parameter->getClass()->name));
			}
			return $dependencies;
		}

	}