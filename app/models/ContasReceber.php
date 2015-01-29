<?php

use \ParticipacaoEvento;
use \InscricaoEvento;

class ContasReceber extends Eloquent  {
  /**
   * [$timestamps description]
   * @var boolean
   */
  public $timestamps = false;

  /**
   * [$table description]
   * @var string
   */
  protected $table   = 'z_contas_receber';

  /**
   * [$participation description]
   * @var [type]
   */
  protected $participation;

  /**
   * [$subscription description]
   * @var [type]
   */
  protected $subscription;

  /**
   * [$spReturn description]
   * @var integer
   */
  protected $spReturn = 0;

  /**
   * [$storedProcedure description]
   * @var string
   */
  protected $storedProcedure = "{call zp_contas_receber_inc_congresso(?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?)}";

  /**
   * [__construct description]
   */
  public function __construct()
  {
    $this->participation = new ParticipacaoEvento();
    $this->subscription  = new InscricaoEvento();
  }

  /**
   * [generateBillet description]
   * @param  [type] $participation [description]
   * @param  [type] $cpf           [description]
   * @return [type]                [description]
   */
  public function generate($participation, $cpf, $dinner = false)
  {
    $data = $this->prepareData($participation, $cpf, $dinner);

    try {
      DB::transaction(function() use ($data) {
        DB::statement($this->storedProcedure, $data);
        return $this->spReturn;
      });
    } catch (Exception $e) {
      echo "<pre>";
      dd($e->getMessage());
    }
  }

  /**
   * [prepareData description]
   * @param  [type] $participation [description]
   * @param  [type] $cpf           [description]
   * @return [type]                [description]
   */
  public function prepareData($participation, $cpf, $dinner = false)
  {
    $participation = $this->participation->getParticipation($participation);
    $subscription  = $this->subscription->getByCpf($cpf, $dinner);
    $finalDate = date('d\/m\/Y', strtotime('+2 day'));

    //dd($participation->id_plano, $subscription, $cpf, $dinner, $finalDate);

    $id_sp = null;
    $data = array($subscription->numero, $participation->nome, 1, $participation->valor, 'P', 0.0, 0, 'P', 0, 0, $finalDate, $participation->id_plano, 'C', $cpf, 8, 'SR', '(sistema)', 'S', $this->spReturn);

    return $data;
  }

  /**
   * [verifySubscription description]
   * @param  [type] $cpf           [description]
   * @param  [type] $participation [description]
   * @return [type]                [description]
   */
  public function verify($participation, $cpf, $dinner = false)
  {
    $subscription  = $this->subscription->getByCpf($cpf, $dinner);

    //dd($subscription);

    if (is_null($subscription)) {
      return null;
    }

    $billet = ContasReceber::where('documento', '=', $subscription->numero)
      ->whereIn('id_situacao', [1,2])
      ->orderBy('id', 'DESC,')
      ->first();

    //dd($billet);

    if (count($billet) &&
       ($billet->id_situacao == 2 ||
       (new DateTime('now')) <= (new DateTime($billet->dt_vencimento)))) {
      return $billet;
    }

    return false;
  }

  /**
   * [show description]
   * @param  [type] $billet [description]
   * @return [type]         [description]
   */
  public function show($billet)
  {
    $id = is_object($billet) ? $billet->id : $billet;
    $url = 'http://professor.uninovafapi.edu.br/relatorios/boletoevento.aspx?id=' . $id;

    return \Redirect::away($url);
  }

  /**
   * [updateBilletDueNotification description]
   * @param  [type] $data     [description]
   * @param  [type] $document [description]
   * @return [type]           [description]
   */
  public function updateBilletDueNotification($status, $data, $document)
  {
    if ($status == 3) {
      $data = [
        'valor_pago'        => $transaction->getGrossAmount(),
        'usuario_baixa'     => 'pagseguro',
        'id_localpagamento' => 2,
        'id_formapagamento' => 1,
        'observacoes'       => 'Codigo pagseguro: ' . $transaction->getPaymentMethod()->getCode()->getValue(),
        'id_situacao'       => 2,
        'dt_pagamento'      =>  (new DateTime($transaction->getDate()))->format('d-m-Y')];
      $document = substr($data['reference'], 4);

      return $this
        ->where(function ($query) {
          $query->where('documento', '=', $document);
          $query->where('id_situacao', '=', 1);
        })
        ->update($data);
    }

    throw new Exception('Erro atualizando transação');
  }
}