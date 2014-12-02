<?php
namespace User;

use \View;
use \Input;
use \Config;
use \Auth;
use \Redirect;
use \Hash;

class LoginController extends \BaseController {

  /**
   * [loginPage description]
   * @return [type] [description]
   */
  public function loginPage()
  {
    $content = null;
    return View::make("panel.login", ['title' => 'Painel do Congressista', 'content' => $content]);
  }

  /**
   * [loginAction description]
   * @return [type] [description]
   */
  public function loginAction()
  {
    $email    = Input::get('email');
    $password = Input::get('password');

    if (Auth::attempt(['email' => $email, 'password' => $password])) {
      $user = (new \User)->findByEmail($email);
      \Session::put('nome', $user['nome']);

      return Redirect::intended('panel/main');
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
    return Redirect::route('user.login');
  }
}
