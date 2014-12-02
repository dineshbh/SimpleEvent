<?php
namespace Admin;

use \View;

class ContentController extends \BaseController {
	/**
	 * [$content_type description]
	 * @var [type]
	 */
	protected $content_type;

	/**
	 * [$content_path description]
	 * @var [type]
	 */
	protected $content_path;

	/**
	 * [$content description]
	 * @var [type]
	 */
	protected $content = null;

	/**
	 * [$base_language description]
	 * @var string
	 */
	protected $base_language = 'pt';

	/**
	 * [$model description]
	 * @var [type]
	 */
	protected $model;

	/**
	 * [listing description]
	 * @return [type] [description]
	 */
	public function listing()
	{
		return View::make("admin.index" . ucfirst($this->content_type), ['title' => 'Painel Administrativo', 'content' => $this->content]);
	}

	/**
	 * [create description]
	 * @return [type] [description]
	 */
	public function create()
	{
		return View::make("admin.create" . ucfirst($this->content_type), ['title' => 'Painel Administrativo', 'content' => $this->content]);
	}

	/**
	 * [edit description]
	 * @param  [type] $slug    [description]
	 * @param  [type] $content [description]
	 * @return [type]          [description]
	 */
	public function edit($slug, $content = null)
	{
		return View::make("admin.edit" . ucfirst($this->content_type),
			[
				'title' => 'Painel Administrativo',
				'content' => $this->content,
				'slug' => $slug,
				$this->content_type => $content,
				'name' => \Helpers\I18nHelper::getPageNameFromSlug($slug)
			]);
	}
}