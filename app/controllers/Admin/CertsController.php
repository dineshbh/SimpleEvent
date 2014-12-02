<?php
namespace Admin;

use \View;

class CertsController extends ContentController {
  /**
   * [__construct description]
   */
	public function __construct()
	{
		$this->content = 'Certs Controller Listing!!';
	}

  /**
   * [listing description]
   * @return [type] [description]
   */
	public function listing()
	{
		$content = null;
		return View::make("admin.certificados", ['title' => 'Painel Administrativo', 'content' => $content]);
	}
}