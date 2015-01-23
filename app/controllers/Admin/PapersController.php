<?php
namespace Admin;

use \View;

class PapersController extends ContentController {

  protected $papers;
  /**
   * [__construct description]
   */
	public function __construct(\Trabalhos $papers)
	{
    $this->content = 'Papers Controller Listing!!';
    $this->papers  = $papers;
	}

  /**
   * [listing description]
   * @return [type] [description]
   */
	public function listing()
	{
		$papers = $this->papers->fetchAll();
		return View::make("admin.trabalhos", ['title' => 'Painel Administrativo', 'papers' => $papers]);
	}

  public function status()
  {
    $this->papers->statusUpdate(\Input::except('_token'));
    return \Redirect::back();
  }

  public function editPaper()
  {
    //return \Redirect::back();
  }
}