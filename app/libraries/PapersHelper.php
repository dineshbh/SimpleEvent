<?php namespace Helpers;

class PapersHelper {
  /**
   * [choices description]
   * @return [type] [description]
   */
  public static function choices()
  {
    $options = [
      ''  => trans('papers.escolha'),
      '1' => trans('papers.poster'),
      '2' => trans('papers.oral')
    ];
    return $options;
  }
}