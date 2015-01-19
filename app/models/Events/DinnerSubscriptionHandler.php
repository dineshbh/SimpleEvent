<?php
namespace Events;

class DinnerSubscriptionHandler {

    protected $billet;

    public function __construct(\ContasReceber $billet)
    {
      $this->billet = $billet;
    }

    public function handle($data)
    {
      \Log::info("jantar: {$data['cpf']}}");
      $dinner = $this->billet->generate(
        $data['jantar_id'],
        $data['cpf'],
        true);
      \Log::info("jantar ok");
    }

}