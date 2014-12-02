<?php namespace Validation;

class TalksFormValidator extends FormValidator {
  /**
   * [$rules description]
   * @var [type]
   */
	protected $rules = [
		'language' => 'required'
	];
}