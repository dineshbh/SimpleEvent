<?php namespace User;

use \App;
use \Session;
use \Input;

class PaymentController extends \BaseController {

  /**
   * [$billet description]
   * @var [type]
   */
  protected $billet;

  /**
   * [__construct description]
   * @param ContasReceber $billet [description]
   */
  public function __construct(\ContasReceber $billet)
  {
    $this->billet = $billet;
  }

  /**
   * [payment description]
   * @return [type] [description]
   */
  public function payment()
  {
    $participation = Input::get('participacao');
    $type          = Input::get('type');
    $cpf           = Input::get('cpf');

    $billet = $this->billet->verify($participation, $cpf);

    if (!$billet) {
      $this->billet->generate($participation, $cpf);
      $billet = $this->billet->verify($participation, $cpf);
    }

    switch ($type) {
      case 'billet': return self::billet($billet);
      case 'pagseguro': return self::pagseguro($billet);
      default: throw \Exception('Formato de pagamento não suportado');
    }
  }

  /**
   * [billet description]
   * @param  [type] $participation [description]
   * @param  [type] $cpf           [description]
   * @return [type]                [description]
   */
  public function billet($billet)
  {
    return $this->billet->show($billet);
  }

  /**
   * [pagseguro description]
   * @param  [type] $billet [description]
   * @return [type]         [description]
   */
  public function pagseguro($billet)
  {
    // criar procedimento de pagamento no pagseguro
    $pagseguro = new \PagSeguro();

    $user   = \User::where('cpf', '=', $billet->codigo)->first();
    $params = self::pagseguroData($user, $billet);

    $url = $pagseguro->paymentUrl($params);

    return \Redirect::away($url);
  }

  /**
   * [pagseguroData description]
   * @param  [type] $user   [description]
   * @param  [type] $billet [description]
   * @return [type]         [description]
   */
  public function pagseguroData($user, $billet)
  {
    $cep = ($user->cep) ? str_replace('-', '', $user->cep) : '64000000';

    $pagseguro = [
      'Sender' => [
        'name' => $user->nome,
        'email' => $user->email,
        'areaCode' => substr($user->telefone, 5, 2),
        'number' => substr($user->telefone, 9)
      ],
      'Address' => [
        'postalCode' => $cep,
        'street' => $user->endereco,
        'number' => $user->numero,
        'complement' => $user->complemento,
        'district' => $user->bairro,
        'city' => $user->cidade,
        'state' => $user->uf,
        'country' => $user->pais
      ],
      'Item' => [
        'id' => $user->profissao,
        'description' => $billet->descricao,
        'quantity' => 1,
        'amount' => round($billet->valor, 2)
      ],
      'reference' => 'EV' . $billet->documento,
    ];

    return $pagseguro;
  }
}