<?php namespace User;

use \Auth;
use \View;
use \Input;
use \Redirect;
use \Validation\TalksFormValidator;

class TalksController extends \BaseController {
  /**
   * [$talkForm description]
   * @var [type]
   */
  protected $talkForm;

  /**
   * [$paperForm description]
   * @var [type]
   */
  protected $paperForm;

  /**
   * [__construct description]
   * @param UpdateFormValidator $loginForm [description]
   */
  public function __construct(TalksFormValidator $talkForm, \User $userModel)
  {
    $this->talkForm = $talkForm;
    $this->userModel = $userModel;
  }

  /**
   * [indexPage description]
   * @return [type] [description]
   */
  public function listing()
  {
    $title = 'Mesas Redondas';
    $user  = Auth::user();

    $billing = new \ContasReceber();
    $billet  = $billing->verify($user->profissao, $user->cpf);

    $view = (!$billet OR $billet->id_situacao != 2) ? 'panel.payment' : 'panel.talks.listing';

    return View::make($view, ['title' => $title, 'user' => $user, 'lang' => $user->lang]);
  }
}