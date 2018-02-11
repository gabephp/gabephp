<?php

namespace core\response;

class Response {

	/**
	 * @var string
	 */
	protected $text = '';

	/**
	 * Response constructor.
	 *
	 * @param string $text
	 * @param string $contentType
	 * @param int $statusCode
	 */
	public function __construct(string $text, int $statusCode = 200, string $contentType = 'text/html') {
		global $gabephp;
		$this->text = $text;
		if (!$this->validateStatusCode($statusCode)) {
			throw new \InvalidArgumentException('Invalid status code specified.');
		}
		header('HTTP/1.1 ' . $statusCode . ' ' . $gabephp->getConfiguration('statuscodes')[$statusCode]['message']);
		if (!$this->validateContentType($contentType)) {
			throw new \InvalidArgumentException('Invalid content type specified.');
		}
		header('Content-Type:' . $contentType);
	}

	/**
	 * Validate the specified content type.
	 *
	 * @param string $contentType
	 *
	 * @return bool
	 */
	protected function validateContentType(string $contentType) {
		global $gabephp;
		return (in_array($contentType, $gabephp->getConfiguration('mimetypes')['allowed']) &&
		        !in_array($contentType, $gabephp->getConfiguration('mimetypes')['disallowed']));
	}

	/**
	 * Validate the specified status code.
	 *
	 * @param int $statusCode
	 *
	 * @return bool
	 */
	protected function validateStatusCode(int $statusCode) {
		global $gabephp;
		return array_key_exists($statusCode, $gabephp->getConfiguration('statuscodes'));
	}

	/**
	 * Send the response to the client.
	 */
	public function send() {
		echo $this->text;
	}
}