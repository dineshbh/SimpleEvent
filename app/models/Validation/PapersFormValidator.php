<?php namespace Validation;

class PapersFormValidator extends FormValidator {
  /**
   * [$rules description]
   * @var [type]
   */
	protected $rules = [
		'language' => 'required'
	];
}