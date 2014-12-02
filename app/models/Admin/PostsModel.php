<?php namespace Admin;

use \File;
use \View;
use \App;

class PostsModel implements ContentModelInterface {
	/**
	 * [$langs description]
	 * @var [type]
	 */
	private $langs = ['pt', 'en', 'fr'];

	/**
	 * [$content_path description]
	 * @var [type]
	 */
	private $content_path;

	/**
	 * [__construct description]
	 * @param [type] $content_path [description]
	 */
	public function __construct($content_path)
	{
		$this->content_path = $content_path;
		return $this;
	}

	/**
	 * [all description]
	 * @param  integer $limit [description]
	 * @return [type]         [description]
	 */
	public function all($limit = 0)
	{
		$pages = [];

		foreach (File::directories($this->content_path) as $posts) {
			//var_dump($posts); die();
			$id = explode('\\', $posts)[5];

			if (File::files($posts)) {
				$pages[] = $id;
			}

			// if someone wants to use pagination...
			if ($limit && (count($pages) >= $limit)) {
				break;
			}
		}

		return $pages;
	}

	/**
	 * [get description]
	 * @param  [type]  $id   [description]
	 * @param  boolean $only [description]
	 * @return [type]        [description]
	 */
	public function get($id, $only = false)
	{
		$posts = ['id' => $id];

		foreach ($this->langs as $lang) {
			$posts[$lang] = [
				'title' => $this->getPostTitle($id, $lang),
				'content' => $this->getPostContent($id, $lang)
			];
		}

		return $only ? $posts[$only] : $posts;
	}

	/**
	 * [save description]
	 * @param  [type]  $id       [description]
	 * @param  [type]  $data     [description]
	 * @param  boolean $creating [description]
	 * @return [type]            [description]
	 */
	public function save($id, $data, $creating = false)
	{
		$folder_path = $this->content_path . $id;

		foreach ($this->langs as $lang) {
			if ($creating) {
				$this->createFolderPath($folder_path);
			}

			$page_path = $folder_path . "\\{$lang}.php";

			try {
				File::put($page_path, View::make('admin.savePosts', [
					'title' => $data[$lang]['title'],
					'content' => $data[$lang]['content']
				]));
			} catch (Exception $e) {
				return false;
			}
		}
		return true;
	}

	/**
	 * [getPostMetaData description]
	 * @param  [type] $posts [description]
	 * @return [type]        [description]
	 */
	public function getPostMetaData($posts)
	{
		$posts = array_map(function($value) {
			return [
				'name' => $this->getPostTitle($value, 'pt'),
				'slug' => $value,
				'last_modified' => File::lastModified($this->content_path . $value)
			];
		}, $posts);
		rsort($posts);

		return $posts;
	}

	/**
	 * [getPostTitle description]
	 * @param  [type] $id   [description]
	 * @param  [type] $lang [description]
	 * @return [type]       [description]
	 */
	private function getPostTitle($id, $lang)
	{
		$path = $this->content_path . $id . "\\{$lang}.php";

		if (File::exists($path)) {
			$title = explode('-----', File::get($path))[0];
			$title = explode(':', $title)[1];
			return $title;
		}

		return ("Post #" . $id);
	}

	/**
	 * [getPostContent description]
	 * @param  [type] $id   [description]
	 * @param  [type] $lang [description]
	 * @return [type]       [description]
	 */
	private function getPostContent($id, $lang)
	{
		$path = $this->content_path . $id . "\\{$lang}.php";

		if (File::exists($path)) {
			$content = explode('-----', File::get($path))[1];
			return $content;
		}

		return '';
	}

	/**
	 * [createFolderPath description]
	 * @param  [type] $folder_path [description]
	 * @return [type]              [description]
	 */
	private function createFolderPath($folder_path)
	{
		if (!File::exists($folder_path)) {
			try {
				File::makeDirectory($folder_path);
			} catch (Exception $e) {
				return \App::abort(404);
			}
		}
	}
}