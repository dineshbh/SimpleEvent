<?php namespace Helpers;

class PapersHelper {

  public static function status($statusID)
  {
    switch ($statusID){
      case null: return 'Em análise';
      case 0: return 'Negado';
      case 1: return 'Aceito';
    }
  }

  /**
   * [choices description]
   * @return [type] [description]
   */
  public static function choices()
  {
    $options = [
      ''  => trans('papers.escolha.title'),
      '1' => trans('papers.escolha.poster'),
      '2' => trans('papers.escolha.oral'),
      /*'3' => trans('papers.escolha.premiacao')*/
    ];
    return $options;
  }

  /**
   * [choiceText description]
   * @param  [type] $choiceId [description]
   * @return [type]           [description]
   */
  public static function choiceText($choiceId)
  {
    switch ($choiceId) {
      case '1' : return trans('papers.escolha.poster');
      case '2' : return trans('papers.escolha.oral');
    }
  }

  public static function language($choiceId)
  {
    switch ($choiceId) {
      case 'pt' : return trans('papers.language.pt');
      case 'en' : return trans('papers.language.en');
      case 'fr' : return trans('papers.language.fr');
    }
  }

  /**
   * [choices description]
   * @return [type] [description]
   */
  public static function axesChoices()
  {
    $options = [
      ''  => trans('papers.eixo.escolha'),
      '0' => trans('papers.eixo.tema0'),
      '1' => trans('papers.eixo.tema1'),
      '2' => trans('papers.eixo.tema2'),
      '3' => trans('papers.eixo.tema3'),
      '4' => trans('papers.eixo.tema4'),
      '5' => trans('papers.eixo.tema5'),
      '6' => trans('papers.eixo.tema6'),
      '7' => trans('papers.eixo.tema7'),
      '8' => trans('papers.eixo.tema8'),
      '9' => trans('papers.eixo.tema9')
    ];
    return $options;
  }

  public static function axisText($axeId)
  {
    switch ($axeId) {
      case '0': return trans('papers.eixo.tema0');
      case '1': return trans('papers.eixo.tema1');
      case '2': return trans('papers.eixo.tema2');
      case '3': return trans('papers.eixo.tema3');
      case '4': return trans('papers.eixo.tema4');
      case '5': return trans('papers.eixo.tema5');
      case '6': return trans('papers.eixo.tema6');
      case '7': return trans('papers.eixo.tema7');
      case '8': return trans('papers.eixo.tema8');
      case '9': return trans('papers.eixo.tema9');
    }
  }
}