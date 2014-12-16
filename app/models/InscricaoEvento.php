<?php

class InscricaoEvento extends Eloquent {
  /**
   * [$table description]
   * @var string
   */
  protected $table   = 'z_inscricao_evento';

  /**
   * [$fillable description]
   * @var [type]
   */
  protected $fillable = ['id_evento', 'id_participacao_evento', 'id_inscrito', 'numero', 'dt_inscricao'];

  /**
   * [user description]
   * @return [type] [description]
   */
  public function user()
  {
      return $this->belongsTo('User', 'id_inscrito');
  }

  /**
   * [participacaoEvento description]
   * @return [type] [description]
   */
  public function participacaoEvento()
  {
      return $this->hasMany('ParticipacaoEvento', 'id', 'id_participacao_evento');
  }

  /**
   * [contasReceber description]
   * @return [type] [description]
   */
  public function contasReceber()
  {
    return $this->hasOne('ContasReceber', 'documento', 'numero');
  }

  /**
   * [createSubscription description]
   * @param  [type] $data [description]
   * @return [type]       [description]
   */
  public function createSubscription($data)
  {
    $user    = new User();
    $user_id = $user->getUserDatabyCPF($data['cpf'], ['id'])->id;

    $existsSubscription = InscricaoEvento::where('id_inscrito', '=', $user_id)
      ->where('id_evento', '=', Config::get('event.id'))
      ->where('id_participacao_evento', '=', $data['perfil'])
      ->get();

    if (count($existsSubscription)) {
      return $existsSubscription;
    }

    $numero = $user->generateDocNumber(
      Config::get('event.id'),
      $data['perfil'],
      $user_id);

    return self::create([
      'id_evento'              => Config::get('event.id'),
      'id_participacao_evento' => $data['perfil'],
      'id_inscrito'            => $user_id,
      'numero'                 => $numero,
      'dt_inscricao'           => date('Y-d-m')
    ]);
  }

  /**
   * [getByCpf description]
   * @param  [type] $cpf [description]
   * @return [type]      [description]
   */
  public function getByCpf($cpf)
  {
    $user = User::where('cpf', '=', $cpf)->first();
    return InscricaoEvento::where('id_inscrito', '=', $user->id)
      ->where('id_evento', '=', Config::get('event.id'))
      ->orderBy('id', 'DESC')
      ->first();
  }

  /**
   * [fetchAllSubscribed description]
   * @return [type] [description]
   */
  public function fetchAllSubscribedToEvent()
  {
    return self::where('id_evento', '=', Config::get('event.id'))->get();
  }

}