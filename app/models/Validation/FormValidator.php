<?php namespace Validation;

use Illuminate\Validation\Factory as Validator;

abstract class FormValidator {
	/**
	 * [$validation description]
	 * @var [type]
	 */
	protected $validation;

	/**
	 * [$validator description]
	 * @var [type]
	 */
	protected $validator;

	/**
	 * [__construct description]
	 * @param Validator $validator [description]
	 */
	public function __construct(Validator $validator)
	{
		$this->validator = $validator;
	}

	/**
	 * [validate description]
	 * @param  array  $formData [description]
	 * @return [type]           [description]
	 */
	public function validate(array $formData)
	{
		$this->validation = $this->validator->make($formData, $this->getValidationRules());

		$this->validation->sometimes(['dadosPessoais.passaporte', 'dadosPessoais.zip'], 'required', function($input) {
			return in_array($input->language, ['fr', 'en']);
		});

		if ($this->validation->fails()) {
			throw new FormValidatorException('Form Validation Failed', $this->getValidationErrors());
		}

		return true;
	}

	/**
	 * [getValidationRules description]
	 * @return [type] [description]
	 */
	protected function getValidationRules()
	{
		return $this->rules;
	}

	/**
	 * [getValidationErrors description]
	 * @return [type] [description]
	 */
	protected function getValidationErrors()
	{
		return $this->validation->errors();
	}

}