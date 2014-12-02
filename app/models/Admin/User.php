<?php
namespace Admin;

class User extends \User {
  /**
   * [$table description]
   * @var string
   */
	protected $table = 'z_evento_usuario';

  /**
   * [$hidden description]
   * @var array
   */
	protected $hidden = array('password', 'senha');

  /**
   * [findByEmail description]
   * @param  [type] $email [description]
   * @return [type]        [description]
   */
	public function findByEmail($email)
	{
		return self::where('email', '=', $email)->firstOrFail();
	}
}