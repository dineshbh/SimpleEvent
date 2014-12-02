<?php namespace Validation;

use Illuminate\Support\MessageBag;

class FormValidatorException extends \Exception {
	/**
	 * [$errors description]
	 * @var [type]
	 */
	protected $errors;

	/**
	 * [__construct description]
	 * @param [type]     $message [description]
	 * @param MessageBag $errors  [description]
	 */
	public function __construct($message, MessageBag $errors)
	{
		$this->errors = $errors;

		parent::__construct($message);
	}

	/**
	 * [getErrors description]
	 * @return [type] [description]
	 */
	public function getErrors()
	{
		return $this->errors;
	}
}