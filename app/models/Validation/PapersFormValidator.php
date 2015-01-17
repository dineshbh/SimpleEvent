<?php namespace Validation;

class PapersFormValidator extends FormValidator {
  /**
   * [$rules description]
   * @var [type]
   */
	protected $rules = [
		'language' => 'required',
    'tipo_trabalho' => 'required',
    'eixo_tematico' => 'required',
    'titulo' => 'required',
    'autor' => 'required',
    'arquivo_identificado' => 'required|max:12000',
    'arquivo_nao_identificado' => 'required|max:12000',
	];
}