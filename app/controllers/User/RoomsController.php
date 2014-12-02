<?php namespace User;

use \Auth;
use \View;
use \Input;
use \Redirect;
use \Validation\RoomsFormValidator;

class RoomsController extends \BaseController {
  /**
   * [$roomForm description]
   * @var [type]
   */
  protected $roomForm;

  /**
   * [$paperForm description]
   * @var [type]
   */
  protected $paperForm;

  /**
   * [__construct description]
   * @param UpdateFormValidator $loginForm [description]
   */
  public function __construct(RoomsFormValidator $roomForm, \User $userModel)
  {
    $this->roomForm = $roomForm;
    $this->userModel = $userModel;
  }

  /**
   * [indexPage description]
   * @return [type] [description]
   */
  public function listing()
  {
    $title = 'Salas';
    $user  = Auth::user();

    $billing = new \ContasReceber();
    $billet  = $billing->verify($user->profissao, $user->cpf);

    $view = (!$billet OR $billet->id_situacao != 2) ? 'panel.payment' : 'panel.rooms.listing';

    return View::make($view, ['title' => $title, 'user' => $user, 'lang' => $user->lang]);
  }
}