<?php namespace User;

use \Auth;
use \View;
use \Input;
use \Redirect;
use \Validation\PapersFormValidator;

class PapersController extends \BaseController {
  /**
   * [$userModel description]
   * @var [type]
   */
  protected $userModel;

  /**
   * [$paperForm description]
   * @var [type]
   */
  protected $paperForm;

  /**
   * [$title description]
   * @var [type]
   */
  private $title;

  /**
   * [__construct description]
   * @param UpdateFormValidator $loginForm [description]
   */
  public function __construct(PapersFormValidator $paperForm)
  {
    $this->paperForm = $paperForm;
    $this->userModel = Auth::user();
    $this->title     = 'Trabalhos';

    $this->beforeFilter('payment');
  }

  /**
   * [indexPage description]
   * @return [type] [description]
   */
  public function listing()
  {
    return View::make('panel.papers.listing', [
      'title' => $this->title,
      'user'  => $this->userModel,
      'lang'  => $this->userModel->lang]);
  }

  /**
   * [create description]
   * @return [type] [description]
   */
  public function create()
  {
    return View::make('panel.papers.create', [
      'title' => $this->title,
      'user'  => $this->userModel,
      'lang'  => $this->userModel->lang]);
  }
}