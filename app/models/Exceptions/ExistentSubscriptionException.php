<?php namespace Exceptions;

class ExistentSubscriptionException extends \Exception {
  /**
   * [__construct description]
   * @param [type] $message [description]
   */
	public function __construct($message)
	{
		parent::__construct($message);
	}
}