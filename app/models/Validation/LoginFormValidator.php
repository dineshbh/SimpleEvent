<?php namespace Validation;

class LoginFormValidator extends FormValidator {
	/**
	 * [$rules description]
	 * @var [type]
	 */
	protected $rules = [
		'language' => 'required',
		'dadosPessoais.nome' => 'required',
		'dadosPessoais.senha' => 'required|min:8',
		'dadosPessoais.confirmarSenha' => 'required|same:dadosPessoais.senha',
		'dadosPessoais.nascimento' => 'required|date_format:d\/m\/Y',
		'dadosPessoais.telefoneFixo' => 'required',
		'dadosPessoais.telefoneCelular' => 'required',
		'dadosPessoais.instituicao' => 'required',
		'dadosPessoais.email' => 'required|email|unique:z_inscritos,email',
		'dadosPessoais.confirmarEmail' => 'required|same:dadosPessoais.email',
		'dadosPessoais.perfil' => 'required',
		'dadosPessoais.endereco' => 'required',
		'dadosPessoais.estado' => 'required',
		'dadosPessoais.pais' => 'required',
		/*'dadosPessoais.jantar' => 'required|in:S,N',*/
		'dadosPessoais.cpf' => 'required_if:language,pt',
		'dadosPessoais.rg' => 'required_if:language,pt',
		'dadosPessoais.bairro' => 'required_if:language,pt',
		'dadosPessoais.cidade' => 'required_if:language,pt',
		'dadosPessoais.cep' => 'required_if:language,pt',
		'dadosPessoais.comprovanteMatricula' => 'required_if:dadosPessoais.perfil,estudante'
	];
}