<?php
namespace Admin;

use \File;
use \Input;
use \Helpers;

class PostsController extends ContentController {
	/**
	 * [$postModel description]
	 * @var [type]
	 */
	private $postModel;

	/**
	 * [__construct description]
	 */
	public function __construct()
	{
		$this->content_type = 'posts';
		$this->content_path = app_path() . DIRECTORY_SEPARATOR . "{$this->content_type}" . DIRECTORY_SEPARATOR;

		$this->model = new PostsModel($this->content_path);
	}

	/**
	 * [create description]
	 * @return [type] [description]
	 */
	public function create()
	{
		$this->content = 'create';
		return parent::create();
	}

	/**
	 * [listing description]
	 * @return [type] [description]
	 */
	public function listing()
	{
		$posts = $this->model->all();
		$this->content = $this->model->getPostMetaData($posts);

		return parent::listing();
	}

	/**
	 * [edit description]
	 * @param  [type] $id    [description]
	 * @param  [type] $pages [description]
	 * @return [type]        [description]
	 */
	public function edit($id, $pages = null)
	{
		$pages = $this->model->get($id);

		return parent::edit($id, $pages);
	}

	/**
	 * [save description]
	 * @param  [type]  $id       [description]
	 * @param  boolean $creating [description]
	 * @return [type]            [description]
	 */
	public function save($id, $creating = false)
	{
		$data = Input::except('_token');

		if (!$this->model->save($id, $data, $creating)) {
			return \Redirect::back()->with('error', 'Ocorreu um erro ao atualizar a página');
		}

		if ($creating) {
			return \Redirect::to('admin/noticias/')->with('success', 'Página criada com sucesso');
		}

		return \Redirect::back()->with('success', 'Página atualizada com sucesso');
	}

	/**
	 * [delete description]
	 * @param  [type] $id [description]
	 * @return [type]     [description]
	 */
	public function delete($id)
	{
		if (!File::deleteDirectory($this->content_path . $id)) {
			return \Redirect::back()->with('error', 'Ocorreu um erro ao criar a página');
		}

		return \Redirect::back()->with('success', 'Página excluída com sucesso');
	}
}