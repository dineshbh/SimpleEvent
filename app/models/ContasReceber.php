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
  public function generate($participation, $cpf)
  {
    $data = $this->prepareData($participation, $cpf);

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
  public function prepareData($participation, $cpf)
  {
    $participation = $this->participation->getParticipation($participation);
    $subscription  = $this->subscription->getByCpf($cpf);
    $finalDate = date('d\/m\/Y', strtotime('+2 day'));

    $id_sp = null;
    $data = array($subscription->numero, $participation->nome, 1, $participation->valor, 'P', 0.0, 0, 'P', 0, 0, $finalDate, $participation->id_plano, 'C', $cpf, 4, 'SR', '(sistema)', 'S', $this->spReturn);

    return $data;
  }

  /**
   * [verifySubscription description]
   * @param  [type] $cpf           [description]
   * @param  [type] $participation [description]
   * @return [type]                [description]
   */
  public function verify($participation, $cpf)
  {
    $subscription  = $this->subscription->getByCpf($cpf);

    $billet = ContasReceber::where('documento', '=', $subscription->numero)
      ->whereIn('id_situacao', [1,2])
      ->orderBy('id', 'DESC,')
      ->first();

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
    $url = 'http://professor.uninovafapi.edu.br/relatorios/boletoevento.aspx?id=' . $billet->id;
    return \Redirect::away($url);
  }
}