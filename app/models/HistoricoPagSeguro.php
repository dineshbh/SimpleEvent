<?php

class HistoricoPagSeguro extends Eloquent {
  /**
   * [$timestamps description]
   * @var boolean
   */
  public $timestamps = false;

  /**
   * [$table description]
   * @var string
   */
  protected $table   = 'z_evento_HistoricoPagSeguro';


  /**
   * [getNotificationByCode description]
   * @param  [type] $code [description]
   * @return [type]       [description]
   */
  public function getNotificationByCode($code)
  {
    $notification = $this->where('code', '=', $code)->first();
    if (count($notification) > 0) {
      throw new Exception("Codigo de transacao ja foi inserido no sistema. {$code}");
    }
  }

  /**
   * [checkTransactions description]
   * @param  [type] $transaction [description]
   * @param  [type] $credentials [description]
   * @param  [type] $code        [description]
   * @return [type]              [description]
   */
  public function checkTransactions($transaction, $credentials, $code)
  {
    if($transaction === 'transaction'){
      return \PagSeguroNotificationService::checkTransaction($credentials, $code);
    }
  }

  /**
   * [reference description]
   * @param  [type] $transaction [description]
   * @return [type]              [description]
   */
  public function reference($transaction)
  {
    // pega referencia (consultar na API)
    if('JIRS' === substr($transaction->getReference(), 0, 4)){
      return $transaction->getReference();
    }else{
      return 'JIRS' . $transaction->getReference();
    }
  }
}