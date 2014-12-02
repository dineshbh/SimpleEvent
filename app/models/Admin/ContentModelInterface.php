<?php namespace Admin;

interface ContentModelInterface {
  /**
   * [get description]
   * @param  [type] $slug [description]
   * @return [type]       [description]
   */
	public function get($slug);

  /**
   * [save description]
   * @param  [type] $slug [description]
   * @param  [type] $data [description]
   * @return [type]       [description]
   */
	public function save($slug, $data);
}