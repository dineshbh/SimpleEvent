<?php namespace Filters;

use \View;
use \Auth;

class DinnerFilter {

  const DINNER_ID = 2629;

  /**
   * [filter description]
   * @return [type] [description]
   */
  public function filter()
  {
    $user = Auth::user();

    $billing = new \ContasReceber();
    $billet  = $billing->verify(self::DINNER_ID, $user->cpf, true);

    if (!$billet OR $billet->id_situacao != 2) {
      \Session::put('dinner', $billet);
    }
  }

}