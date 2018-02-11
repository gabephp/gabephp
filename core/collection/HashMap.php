<?php

	namespace core\collection;

	class HashMap {

		/**
		 * @var array
		 */
		protected $keys = array();

		/**
		 * @var array
		 */
		protected $values = array();

		/**
		 * Checks if a specified key exists in this HashMap.
		 *
		 * @param $key
		 *
		 * @return bool
		 */
		public function hasKey($key) {
			return in_array($key, $this->keys);
		}

		/**
		 * Checks if a specified value exists in this HashMap.
		 *
		 * @param $value
		 *
		 * @return bool
		 */
		public function hasValue($value) {
			return in_array($value, $this->keys);
		}

		/**
		 * Returns the index of a specified key.
		 *
		 * @param $key
		 *
		 * @return bool|int
		 */
		public function getKeyIndex($key) {
			foreach($this->keys as $keyIndex=>$keyValue) {
				if($key == $keyValue) {
					return $keyIndex;
				}
			}
			return false;
		}

		/**
		 * Returns the index of a specified value.
		 *
		 * @param $value
		 *
		 * @return bool|int
		 */
		public function getValueIndex($value) {
			foreach($this->values as $valueIndex=>$valueValue) {
				if($value == $valueValue) {
					return $valueIndex;
				}
			}
			return false;
		}

		/**
		 * Returns the list of keys.
		 *
		 * @return array
		 */
		public function getKeySet() {
			return $this->keys;
		}

		/**
		 * Adds a key and value pair to the HashMap.
		 *
		 * @param $key
		 * @param $value
		 */
		public function put($key, $value) {
			array_push($this->keys, $key);
			array_push($this->values, $value);
		}

		/**
		 * Clears the HashMap.
		 */
		public function clear() {
			$this->keys = array();
			$this->values = array();
		}

		/**
		 * Returns the requested value using a specified key.
		 *
		 * @param $key
		 *
		 * @return mixed
		 */
		public function get($key) {
			foreach($this->keys as $keyIndex=>$keyValue) {
				if($key == $keyValue) {
					return $this->values[$keyIndex];
				}
			}
			return null;
		}

		/**
		 * Returns the requested value using a specified index.
		 *
		 * @param $index
		 *
		 * @return mixed
		 */
		public function getByIndex($index) {
			if(array_key_exists($index, $this->values)) {
				return $this->values[$index];
			} else {
				return null;
			}
		}

		/**
		 * Removes a value from the HashMap using a specified key.
		 *
		 * @param $key
		 */
		public function remove($key) {
			foreach($this->keys as $keyIndex=>$keyValue) {
				if($key == $keyValue) {
					unset($this->keys[$keyIndex]);
					unset($this->values[$keyIndex]);
				}
			}
		}

		/**
		 * Removes a value from the HashMap using a specified index.
		 *
		 * @param $index
		 */
		public function removeByIndex($index) {
			if(array_key_exists($index, $this->values)) {
				unset($this->keys[$index]);
				unset($this->values[$index]);
			}
		}
	}