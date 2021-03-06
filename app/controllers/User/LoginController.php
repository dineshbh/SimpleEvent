<?php
namespace User;

use \View;
use \Input;
use \Config;
use \Auth;
use \Redirect;
use \Hash;
use \User as User;

class LoginController extends \BaseController {

  /**
   * [$user description]
   * @var [type]
   */
  protected $user;

  /**
   * [__construct description]
   * @param User $user [description]
   */
  public function __construct(User $user)
  {
    $this->user = $user;
  }

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

    //var_dump(Input::all()); die();

    if (Auth::attempt(['email' => $email, 'password' => $password])) {
      \Session::put('nome', Auth::user()->nome);

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

  public function recovery()
  {
    return $this->user->recover(Input::get('email_recuperar'));
  }
}
