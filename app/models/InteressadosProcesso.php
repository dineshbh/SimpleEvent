<?php

class InteressadosProcesso extends Eloquent {
	/**
	 * [$timestamps description]
	 * @var boolean
	 */
	public $timestamps = false;

	/**
	 * [$table description]
	 * @var string
	 */
	protected $table   = 'Interessados_Processo';

	/**
	 * [userExists description]
	 * @param  [type] $card     [description]
	 * @param  [type] $cardInfo [description]
	 * @return [type]           [description]
	 */
	public function userExists($card, $cardInfo)
	{
		return self::where($card, '=', $cardInfo)->first();
	}

	/**
	 * [createInterested description]
	 * @param  [type] $userData [description]
	 * @param  [type] $card     [description]
	 * @return [type]           [description]
	 */
	public function createInterested($userData, $card)
	{
		if ($this->userExists($card, $userData[$card])) {
			return $this->updateUser($userData);
		}

		return $this->createNewUser($userData, $card);
	}

	/**
	 * [updateUser description]
	 * @param  [type] $userData [description]
	 * @return [type]           [description]
	 */
	public function updateUser($userData)
	{
		return true;
	}

	/**
	 * [createNewUser description]
	 * @param  [type] $userData [description]
	 * @param  [type] $card     [description]
	 * @return [type]           [description]
	 */
	public function createNewUser($userData, $card)
	{
		//echo '<pre>';dd($userData);
		$this->idInteressado = $userData[$card];
		$this->Nome          = $userData['nome'];
		$this->Fone          = $userData['telefoneFixo'];
		$this->Celular       = $userData['telefoneCelular'];
		$this->Endereco      = $userData['endereco'];
		$this->Numero        = $userData['numero'];
		$this->Bairro        = $userData['bairro'];
		$this->Cidade        = $userData['cidade'];
		$this->CEP           = $userData['cep'];
		$this->UF            = "PI";
		$this->Email         = $userData['email'];
		$this->cpf           = $userData['cpf'];
		$this->senha         = '';
		$this->passaporte    = $userData['passaporte'];
		$this->ativo         = 1;

		return $this->save();
	}
}
