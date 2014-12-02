<?php namespace Filters;

use \View;
use \Auth;

class PaymentFilter {

  /**
   * [filter description]
   * @return [type] [description]
   */
  public function filter()
  {
    $user = Auth::user();

    $billing = new \ContasReceber();
    $billet  = $billing->verify($user->profissao, $user->cpf);

    if (!$billet OR $billet->id_situacao != 2) {
      return View::make('panel.payment', [
        'title' => 'Pagamento',
        'user' => $user,
        'lang' => $user->lang]);
    }
  }

}