<?php

use Validation\LoginFormValidator;

class SigninController extends \BaseController {
	/**
	 * [$loginForm description]
	 * @var [type]
	 */
	protected $loginForm;

	/**
	 * [$userModel description]
	 * @var [type]
	 */
	protected $userModel;

	/**
	 * [__construct description]
	 * @param LoginFormValidator $loginForm [description]
	 * @param User               $userModel [description]
	 */
	public function __construct(LoginFormValidator $loginForm, User $userModel)
	{
		$this->loginForm = $loginForm;
		$this->userModel = $userModel;
	}

	/**
	 * [signupForm description]
	 * @param  [type] $lang [description]
	 * @return [type]       [description]
	 */
	public function signupForm($lang)
	{
		App::setLocale($lang);
		return View::make('pages.subscriptions', ['lang' => $lang]);
	}

	/**
	 * [processSignup description]
	 * @return [type] [description]
	 */
	public function processSignup()
	{
		$data = Input::all();
		$this->loginForm->validate($data);

		if ($user = $this->userModel->createUser(Input::except('_token')))
		{
			Auth::loginUsingId($user->id);
			\Session::put('nome', $user->nome);
			\Session::put('lang', $user->lang);
			\Session::flash('signupsuccess', true);
			return Redirect::route('panel.main');
		}

		// On creating error
		// Redirect back with errors
		return Redirect::back()->withInput()->withMessage('Erro ao salvar');
	}
}