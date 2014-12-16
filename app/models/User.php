<?php

use Illuminate\Auth\UserInterface;
use Illuminate\Auth\Reminders\RemindableInterface;
use \Helpers;

class User extends Eloquent implements UserInterface, RemindableInterface {

	/**
	 * The database table used by the model.
	 *
	 * @var string
	 */
	protected $table = 'z_inscritos';

	/**
	 * The attributes excluded from the model's JSON form.
	 *
	 * @var array
	 */
	protected $hidden = array('password', 'senha');

	/**
	 * Get the unique identifier for the user.
	 *
	 * @return mixed
	 */
	public function getAuthIdentifier()
	{
		return $this->getKey();
	}

	/**
	 * Get the password for the user.
	 *
	 * @return string
	 */
	public function getAuthPassword()
	{
		return $this->password;
	}

	/**
	 * Get the e-mail address where password reminders are sent.
	 *
	 * @return string
	 */
	public function getReminderEmail()
	{
		return $this->email;
	}

	public function inscricaoEvento()
  {
      return $this->hasMany('InscricaoEvento', 'id_inscrito', 'id');
  }

	/**
	 * [createUser description]
	 * @param  array  $data [description]
	 * @return [type]       [description]
	 */
	public function createUser(array $data)
	{
		$userData = $data['dadosPessoais'];
		$language = $data['language'];
		$card     = empty($userData['passaporte']) ? 'cpf' : 'passaporte';

		$userData = $this->cleanUpFormData($userData);

		DB::transaction(function() use ($userData, $card, $language)
		{
			$user = new InteressadosProcesso;
			if (
			    !$user->createInterested($userData, $card)  ||
			    !$this->_createUser($userData, $language)   ||
			    !$this->createEventSubscription($userData))
			{
				// create a translation to this error
				throw new \Exceptions\UserCreationException("Houve um problema ao cadastrar usuário");
			}
		});

		return $this->getUserDatabyCPF($userData['cpf']);
	}

	/**
	 * [updateUser description]
	 * @param  array  $data [description]
	 * @return [type]       [description]
	 */
	public function updateUser(array $data)
	{
		$userData = $data['dadosPessoais'];
		$language = $data['language'];
		$card     = empty($userData['passaporte']) ? 'cpf' : 'passaporte';

		$userData = $this->cleanUpFormData($userData);

		DB::transaction(function() use ($userData, $card, $language)
		{
			if (!$this->_createUser($userData, $language))
			{
				// create a translation to this error
				throw new \Exceptions\UserCreationException("Houve um problema ao cadastrar usuário");
			}
		});

		return $this->getUserDatabyCPF($userData[$card]);
	}

	/**
	 * [cleanUpFormData description]
	 * @param  [type] $data [description]
	 * @return [type]       [description]
	 */
	private function cleanUpFormData($data)
	{
		$data['cpf']    = (isset($data['cpf'])    ? str_replace(['.', '-'], '', $data['cpf']) : '');
		$data['rg']     = (isset($data['rg'])     ? $data['rg'] : '');
		$data['numero'] = (isset($data['numero']) ? $data['numero'] : '');
		$data['bairro'] = (isset($data['bairro']) ? $data['bairro'] : '');
		$data['cidade'] = (isset($data['cidade']) ? $data['cidade'] : '');
		$data['cep']    = (isset($data['cep'])    ? $data['cep'] : $data['zip']);

		return $data;
	}

	/**
	 * [_createUser description]
	 * @param  [type] $userData [description]
	 * @param  [type] $language [description]
	 * @return [type]           [description]
	 */
	private function _createUser($userData, $language)
	{
		// attribution sign (=) purposely done here
		if ($user = $this->userExists($userData['cpf']))
		{
			return $this->_updateUser($user, $userData, $language);
		}

		return $this->createNewUser($userData, $language);
	}

	/**
	 * [userExists description]
	 * @param  [type] $cpf [description]
	 * @return [type]      [description]
	 */
	private function userExists($cpf)
	{
		return self::where('cpf', '=', $cpf)->first();
	}

	/**
	 * [_updateUser description]
	 * @param  [type] $user     [description]
	 * @param  [type] $userData [description]
	 * @param  [type] $language [description]
	 * @return [type]           [description]
	 */
	private function _updateUser($user, $userData, $language)
	{
		$user = $this->fillData($userData, $language, $user, 'update');
		$user->save();

		return true;
	}

	/**
	 * [createNewUser description]
	 * @param  [type] $userData [description]
	 * @param  [type] $language [description]
	 * @return [type]           [description]
	 */
	private function createNewUser($userData, $language)
	{
		$user = new User();
		$user = $this->fillData($userData, $language, $user);
		$user->save();

		return true;
	}

	/**
	 * [createEventSubscription description]
	 * @param  [type] $userData [description]
	 * @return [type]           [description]
	 */
	private function createEventSubscription($userData)
	{
		$ie = (new InscricaoEvento())->createsubscription($userData);

		if (!count($ie)) {
			// create a translation to this error
			throw new \Exceptions\ExistentSubscriptionException('Usuário já possui inscrição no evento');
		}

		return true;
	}

	/**
	 * [fillData description]
	 * @param  [type] $userData [description]
	 * @param  [type] $language [description]
	 * @param  [type] $user     [description]
	 * @return [type]           [description]
	 */
	private function fillData($userData, $language, $user, $type = 'create')
	{
		$date     = $userData['nascimento'];
		$zip      = (isset($userData['zip'])) ? $userData['zip'] : '';

		$user->instituicao     = $userData['instituicao'];
		$user->email           = strtolower($userData['email']);
		$user->nome            = $userData['nome'];
		$user->nome_cracha     = $this->generateBadgeName($userData['nome']);
		$user->cpf             = $userData['cpf'];
		$user->rg              = $userData['rg'];
		$user->data_nascimento = $date;
		$user->cep             = $userData['cep'];
		$user->uf              = $userData['estado'];
		$user->cidade          = $userData['cidade'];
		$user->bairro          = $userData['bairro'];
		$user->endereco        = $userData['endereco'];
		$user->telefone        = $userData['telefoneFixo'];
		$user->celular         = $userData['telefoneCelular'];
		$user->profissao       = $userData['perfil'];
		$user->lang            = $language;
		$user->passaporte      = $userData['passaporte'];
		$user->pais            = $userData['pais'];
		$user->zipcode         = $zip;
		//$user->jantar          = $userData['jantar'];

		if ($type == 'create' || ($type == 'update' && isset($userData['senha_antiga']))) {
			$old_pass = substr(sha1($userData['senha']), 0, 8);
			$new_pass = Hash::make($userData['senha']);

			$user->senha    = $old_pass;
			$user->password = $new_pass;
		}

		return $user;
	}

	/**
	 * [generateBadgeName description]
	 * @param  [type] $name [description]
	 * @return [type]       [description]
	 */
	private function generateBadgeName($name)
	{
		$name = explode(" ", $name);
    $name = $name[0] . " " . $name[count($name) - 1];

    return $name;
	}

	/**
	 * [getUserDatabyCPF description]
	 * @param  [type] $cpf  [description]
	 * @param  [type] $attr [description]
	 * @return [type]       [description]
	 */
	public function getUserDatabyCPF($cpf, $attr = ['*'])
	{
		return self::select($attr)->where('cpf', '=', $cpf)->first();
	}

	/**
	 * [generateDocNumber description]
	 * @param  [type] $event         [description]
	 * @param  [type] $participation [description]
	 * @param  [type] $user          [description]
	 * @return [type]                [description]
	 */
	public function generateDocNumber($event, $participation, $user)
	{
		return (
		  str_pad($event, 3, "0", STR_PAD_LEFT) .
		  str_pad($participation, 0, "0", STR_PAD_LEFT) .
		  str_pad($user, 6, "0", STR_PAD_LEFT));
	}

	/**
	 * [findByEmail description]
	 * @param  [type] $email [description]
	 * @return [type]        [description]
	 */
	public function findByEmail($email)
	{
		return self::where('email', '=', $email)->firstOrFail();
	}
}