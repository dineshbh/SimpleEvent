<?php

class ParticipacaoEvento extends Eloquent {
  /**
   * [$timestamps description]
   * @var boolean
   */
  public $timestamps = false;

  /**
   * [$table description]
   * @var string
   */
  protected $table   = 'z_participacao_evento';

  /**
   * [inscricaoEventos description]
   * @return [type] [description]
   */
  public function inscricaoEventos()
  {
      return $this->hasMany('InscricaoEvento', 'id_participacao_evento');
  }

  /**
   * [participations description]
   * @return [type] [description]
   */
  public static function participations($take = 3)
  {
    return self::where('desconto_ate', '>=', date('Y-d-m'))
      ->where('id_evento', '=', Config::get('event.id'))
      ->orderBy('id', 'asc')
      ->take($take)
      ->get();
  }

  /**
   * [getParticipation description]
   * @param  [type] $participation [description]
   * @return [type]                [description]
   */
  public function getParticipation($participation)
  {
    return (self::where('id', '=', $participation)->first());
  }
}