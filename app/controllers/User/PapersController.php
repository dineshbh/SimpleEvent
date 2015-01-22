<?php namespace User;

use \Auth;
use \View;
use \Input;
use \Redirect;
use \Validation\PapersFormValidator;
use \Trabalhos;

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
   * [$paper description]
   * @var [type]
   */
  protected $paper;

  /**
   * [$title description]
   * @var [type]
   */
  private $title;

  /**
   * [$destination description]
   * @var [type]
   */
  private $destination;

  /**
   * [__construct description]
   * @param UpdateFormValidator $loginForm [description]
   */
  public function __construct(
    PapersFormValidator $paperForm,
    Trabalhos $paper)
  {
    $this->paperForm = $paperForm;
    $this->userModel = Auth::user();
    $this->title     = 'Trabalhos';
    $this->paper     = $paper;

    $this->destination = public_path()
      . DIRECTORY_SEPARATOR
      . "storage"
      . DIRECTORY_SEPARATOR
      . "uploads"
      . DIRECTORY_SEPARATOR;

    $this->beforeFilter('payment');
  }

  /**
   * [indexPage description]
   * @return [type] [description]
   */
  public function listing()
  {
    $papers = $this->paper->fetchPapers($this->userModel->id);

    return View::make('panel.papers.listing', [
      'title'  => $this->title,
      'user'   => $this->userModel,
      'lang'   => $this->userModel->lang,
      'papers' => $papers]);
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

  /**
   * [store description]
   * @return [type] [description]
   */
  public function store()
  {
    $data = Input::all();

    $this->paperForm->validate($data);

    if (!$this->paper->createPaper($data)) {
      \Session::flash('server', trans('papers.submission.server'));
      Redirect::back()->withInput();
    }

    \Session::flash('success', trans('papers.submission.success'));
    return Redirect::route('papers.list');
  }
}