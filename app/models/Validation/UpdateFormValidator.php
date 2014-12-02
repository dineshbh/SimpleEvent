<?php namespace Validation;

class UpdateFormValidator extends FormValidator {
	/**
	 * [$rules description]
	 * @var [type]
	 */
	protected $rules = [
		'language' => 'required',
		'dadosPessoais.nome' => 'required',
		'dadosPessoais.nascimento' => 'required|date_format:d\/m\/Y',
		'dadosPessoais.telefoneFixo' => 'required',
		'dadosPessoais.telefoneCelular' => 'required',
		'dadosPessoais.instituicao' => 'required',
		'dadosPessoais.email' => 'required|email',
		'dadosPessoais.endereco' => 'required',
		'dadosPessoais.estado' => 'required',
		'dadosPessoais.pais' => 'required',
		'dadosPessoais.cpf' => 'required_if:language,pt',
		'dadosPessoais.rg' => 'required_if:language,pt',
		'dadosPessoais.bairro' => 'required_if:language,pt',
		'dadosPessoais.cidade' => 'required_if:language,pt',
		'dadosPessoais.cep' => 'required_if:language,pt',
		'dadosPessoais.comprovanteMatricula' => 'required_if:dadosPessoais.perfil,estudante'
	];
}