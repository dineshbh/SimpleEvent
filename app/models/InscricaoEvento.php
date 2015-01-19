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

  const DINNER_ID = 2629;

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
  public function createSubscription($data, $update = false)
  {
    $user    = new User();
    $user_id = $user->getUserDatabyCPF($data['cpf'], ['id'])->id;

    $basicSubscription = false;
    $dinnerSubscription = false;

    try {
      DB::beginTransaction();

      $basicSubscription = true;

      /*only let user subscribe on both ok*/
      if (!$update) {
        $basicSubscription  = $this->basicSubscription($user, $user_id);
      }

      $dinnerSubscription = true;

      if ($data['jantar'] == 'S') {
        $dinnerSubscription = $this->dinnerSubscription($user, $user_id);
      }
      /*only let user subscribe on both ok*/

      DB::commit();
    } catch (Exception $e) {
      DB::rollback();
      throw new \Exceptions\SubscriptionException('Problema ao gravar dados na base de dados. Tente novamente mais tarde. Se o problema persistir, entre em contato com a administração do site');
    }

    if ($dinnerSubscription) {
      $data['jantar_id'] = self::DINNER_ID;
      Event::fire('dinner.subscription', [$data]);
    }

    return $basicSubscription && $dinnerSubscription;
  }

  /**
   * [basicSubscription description]
   * @param  [type] $user    [description]
   * @param  [type] $user_id [description]
   * @return [type]          [description]
   */
  public function basicSubscription($user, $user_id)
  {
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

  public function dinnerSubscription($user, $user_id)
  {
    $existsSubscription = InscricaoEvento::where('id_inscrito', '=', $user_id)
      ->where('id_evento', '=', Config::get('event.id'))
      ->where('id_participacao_evento', '=', self::DINNER_ID)
      ->get();

    if (count($existsSubscription)) {
      return $existsSubscription;
    }

    $numero = $user->generateDocNumber(
      Config::get('event.id'),
      self::DINNER_ID,
      $user_id);

    return self::create([
      'id_evento'              => Config::get('event.id'),
      'id_participacao_evento' => self::DINNER_ID,
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
  public function getByCpf($cpf, $dinner = false)
  {
    $user = User::where('cpf', '=', $cpf)->first();

    return InscricaoEvento::where('id_inscrito', '=', $user->id)
      ->where(function($query) use ($dinner, $user) {
        $query->where('id_evento', '=', Config::get('event.id'));

        if ($dinner) {
          $dinner = $user->generateDocNumber(
            Config::get('event.id'),
            self::DINNER_ID,
            $user->id);

          $query->where('numero', 'like', "%{$dinner}%");
        } else {
          $dinner = $user->generateDocNumber(
            Config::get('event.id'),
            self::DINNER_ID,
            $user->id);

          $query->whereNotIn('numero', [$dinner]);
        }
      })
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