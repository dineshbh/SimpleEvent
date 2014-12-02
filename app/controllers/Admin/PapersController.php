<?php
namespace Admin;

use \View;

class PapersController extends ContentController {
  /**
   * [__construct description]
   */
	public function __construct()
	{
		$this->content = 'Papers Controller Listing!!';
	}

  /**
   * [listing description]
   * @return [type] [description]
   */
	public function listing()
	{
		$content = null;
		return View::make("admin.trabalhos", ['title' => 'Painel Administrativo', 'content' => $content]);
	}
}