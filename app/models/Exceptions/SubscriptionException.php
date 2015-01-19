<?php namespace Exceptions;

class SubscriptionException extends \Exception {
  /**
   * [__construct description]
   * @param [type] $message [description]
   */
	public function __construct($message)
	{
		parent::__construct($message);
	}
}