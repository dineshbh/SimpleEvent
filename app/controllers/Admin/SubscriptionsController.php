<?php
namespace Admin;

use \View;
use \InscricaoEvento;
use \ParticipacaoEvento;

class SubscriptionsController extends ContentController {
  /**
   * [$subscriptions description]
   * @var [type]
   */
  protected $subscriptions;

  /**
   * [$participations description]
   * @var [type]
   */
  protected $participations;

  /**
   * [__construct description]
   * @param InscricaoEvento    $subscriptions  [description]
   * @param ParticipacaoEvento $participations [description]
   */
	public function __construct(InscricaoEvento $subscriptions,
                              ParticipacaoEvento $participations)
	{
    $this->subscriptions  = $subscriptions;
    $this->participations = $participations;
	}

  /**
   * [listing description]
   * @return [type] [description]
   */
	public function listing()
	{
    $participations = $this->participations->participations(12);

		return View::make("admin.inscricoes", [
                      'title' => 'Painel Administrativo',
                      'participations' => $participations
                      ]);
	}

  /**
   * [listByParticipation description]
   * @param  [type] $id [description]
   * @return [type]     [description]
   */
  public function listByParticipation($id)
  {
    $participation = $this->participations->getParticipation($id);

    return View::make("admin.inscricoesParticipacoes", [
                      'title' => 'Painel Administrativo',
                      'participation' => $participation
                      ]);
  }

  /**
   * [inscricao description]
   * @param  [type] $id [description]
   * @return [type]     [description]
   */
  public function inscricao($id)
  {
    $subscription = $this->subscriptions->find($id);

    return View::make("admin.inscricao", [
                      'title' => 'Painel Administrativo',
                      'inscrito' => $subscription
                      ]);
  }
}