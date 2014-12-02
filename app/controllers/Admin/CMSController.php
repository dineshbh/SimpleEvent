<?php
namespace Admin;

use \View;
use \Input;
use \Config;
use \Auth;
use \Redirect;
use \Hash;

class CMSController extends \BaseController {
	/**
	 * [indexPage description]
	 * @param  [type] $user [description]
	 * @return [type]       [description]
	 */
	public function indexPage($user = null)
	{
		$content = 'Index Page for CMSController';
		return View::make("admin.principal", ['title' => 'Painel Administrativo', 'content' => $content, 'user' => $user]);
	}

	/**
	 * [loginPage description]
	 * @return [type] [description]
	 */
	public function loginPage()
	{
		$content = null;
		return View::make("admin.login", ['title' => 'Painel Administrativo', 'content' => $content]);
	}

	/**
	 * [loginAction description]
	 * @return [type] [description]
	 */
	public function loginAction()
	{
		Config::set('auth.model', '\Admin\User');

		if (Auth::attempt([
			'email' => Input::get('email'),
			'password' => Input::get('password'),
			'active' => 1
		])) {
			$user = (new User)->findByEmail(Input::get('email'));
			\Session::put('nome', $user['nome']);

			Config::set('auth.model', 'User');
		  return Redirect::intended('admin/principal');
		}
		return Redirect::back()->withInput(Input::except('password'));
	}

	/**
	 * [logoutAction description]
	 * @return [type] [description]
	 */
	public function logoutAction()
	{
		Auth::logout();
		return Redirect::to('admin/login');
	}
}
