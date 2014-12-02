<?php namespace Admin;

use \File;

class PagesModel implements ContentModelInterface {
	/**
	 * [$langs description]
	 * @var [type]
	 */
	private $langs = ['pt', 'en', 'fr'];

	/**
	 * [get description]
	 * @param  [type] $slug [description]
	 * @return [type]       [description]
	 */
	public function get($slug)
	{
		$pages = [];

		foreach ($this->langs as $lang) {
			$page_path = $this->getPagefile($slug, $lang);

			$pages[$lang] = File::get($page_path);
		}

		return $pages;
	}

	/**
	 * [save description]
	 * @param  [type] $slug [description]
	 * @param  [type] $data [description]
	 * @return [type]       [description]
	 */
	public function save($slug, $data)
	{
		foreach ($this->langs as $lang) {
			$page_path = $this->getPageFile($slug, $lang);

			try {
				File::put($page_path, $data[$lang]);
			} catch (Exception $e) {
				return false;
			}
		}
		return true;
	}

	/**
	 * [getPageFile description]
	 * @param  [type] $slug [description]
	 * @param  [type] $lang [description]
	 * @return [type]       [description]
	 */
	public function getPageFile($slug, $lang)
	{
		// Get page by $slug for given $lang
		$dir_path = app_path() . '/pages/' . $lang . '/';
		$page_path = $dir_path . $slug . '.php';

		// Create directory if doesn't exist
		if (!File::exists($dir_path)) {
			File::makeDirectory($dir_path);
		}

		// Create blank file if doesn't exist
		if (!File::exists($page_path)) {
			File::put($page_path, '');
		}

		return $page_path;
	}
}