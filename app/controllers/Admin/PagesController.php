<?php
namespace Admin;

use \File;
use \Input;
use \Helpers;

class PagesController extends ContentController {
	/**
	 * [__construct description]
	 */
	public function __construct()
	{
		$this->content_type = 'pages';
		$this->content_path = app_path() . "\\{$this->content_type}\\";
	}

	/**
	 * [listing description]
	 * @return [type] [description]
	 */
	public function listing()
	{
		$this->content = $this->getFileNamesFromFolder();

		return parent::listing();
	}

	/**
	 * [edit description]
	 * @param  [type] $slug  [description]
	 * @param  [type] $pages [description]
	 * @return [type]        [description]
	 */
	public function edit($slug, $pages = null)
	{
		$pages = (new PagesModel())->get($slug);

		return parent::edit($slug, $pages);
	}

	/**
	 * [getFileNamesFromFolder description]
	 * @return [type] [description]
	 */
	protected function getFileNamesFromFolder()
	{
		$path = $this->content_path . $this->base_language;
		$files = Helpers\I18nHelper::$slugs;

		$result = array_map(function($value) use ($path) {
			$file_path = $path . DIRECTORY_SEPARATOR . $value . '.php';

			$date = File::exists($file_path)
							? date('d\/m\/Y H:i:s', File::lastModified($file_path))
							: $date = '-';

			return [
				'slug' => $value,
				'name' => Helpers\I18nHelper::getPageNameFromSlug($value),
				'last_modified' => $date
			];
		}, $files);

		return $result;
	}

	/**
	 * [save description]
	 * @param  [type] $slug [description]
	 * @return [type]       [description]
	 */
	public function save($slug)
	{
		$data = Input::except('_token');
		$this->model = new PagesModel;

		if (!$this->model->save($slug, $data)) {
			return \Redirect::back()->with('error', 'Ocorreu um erro ao atualizar a página');
		}

		return \Redirect::back()->with('success', 'Página atualizada com sucesso');
	}
}