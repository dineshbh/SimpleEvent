<?php namespace Helpers;

class Dates {
  /**
   * [computerize description]
   * @param  [type] $human [description]
   * @return [type]        [description]
   */
	public static function computerize($human)
	{
		return date('Y-d-m', strtotime($human));
	}

  /**
   * [humanize description]
   * @param  [type] $computer [description]
   * @return [type]           [description]
   */
  public static function humanize($computer)
  {
    return date('d\/m\/Y', strtotime($computer));
  }
}