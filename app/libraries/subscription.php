<?php namespace Helpers;

class Subscription {
  /**
   * [choices description]
   * @return [type] [description]
   */
  public static function choices()
  {
    $participations = \ParticipacaoEvento::participations();
    $options = ['' => trans('subscription.perfil-escolha')];
    foreach ($participations as $p) {
      $options[$p->id] = self::convertToSimpleText($p->id);
    }
    return $options;
  }

  /**
   * [convertToSimpleText description]
   * @param  [type] $id [description]
   * @return [type]     [description]
   */
  public static function convertToSimpleText($id)
  {
    switch ($id) {
      // Cascade to Undergraduate
      case 2529:
      case 2532: return trans('subscription.estudanteGraduacao');

      // Cascade to Graduate
      case 2530:
      case 2533: return trans('subscription.estudantePos');

      // Cascade to profissionals
      case 2531:
      case 2534: return trans('subscription.profissional');
    }
  }

  /**
   * [paymentStatus description]
   * @param  [type] $value [description]
   * @return [type]        [description]
   */
  public static function paymentStatus($value)
  {
    return ($value == 1) ? 'Não' : 'Sim';
  }
}