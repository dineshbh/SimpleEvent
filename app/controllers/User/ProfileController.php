<?php namespace User;

use \Auth;
use \View;
use \Input;
use \Redirect;
use \Validation\UpdateFormValidator;

class ProfileController extends \BaseController {
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
   * @param UpdateFormValidator $loginForm [description]
   */
  public function __construct(UpdateFormValidator $loginForm, \User $userModel)
  {
    $this->loginForm = $loginForm;
    $this->userModel = $userModel;
  }

  /**
   * [indexPage description]
   * @return [type] [description]
   */
  public function indexPage()
  {

    $content = 'Index Page for ProfileController';
    $user    = Auth::user();

    //dd($user);

    $billing = new \ContasReceber();
    $billet  = $billing->verify($user->profissao, $user->cpf);

    //dd($billet);

    //dd(\Session::get('dinner'));

    return View::make("panel.user-data.edit", [
      'title'   => 'Painel do Usuário',
      'content' => $content,
      'user'    => $user,
      'lang'    => $user->lang,
      'paid'    => $billet,
      'dinner'  => ['billet' => \Session::get('dinner'), 'id' => 2629]]);
  }

  /**
   * [update description]
   * @return [type] [description]
   */
  public function update()
  {
    $data = Input::all();
    $this->loginForm->validate($data);

    if ($user = $this->userModel->updateUser(Input::except('_token')))
    {
      Auth::loginUsingId($user->id);
      \Session::put('nome', $user->nome);
      \Session::put('lang', $user->lang);
      \Session::flash('updatesuccess', true);
      return Redirect::route('panel.main');
    }

    // On creating error
    // Redirect back with errors
    return Redirect::back()->withInput()->withMessage('Erro ao atualizar dados');
  }
}