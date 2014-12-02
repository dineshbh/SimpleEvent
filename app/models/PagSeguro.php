<?php

class PagSeguro  {
  /**
   * [$lib description]
   * @var [type]
   */
  protected $lib;

  /**
   * [$paymentRequest description]
   * @var [type]
   */
  protected $paymentRequest;

  /**
   * [__construct description]
   */
  public function __construct()
  {
    $this->lib            = \PagSeguroLibrary::init();
    $this->paymentRequest = new \PagSeguroPaymentRequest();
  }

  /**
   * [credentials description]
   * @return [type] [description]
   */
  public function credentials() {
    $credentials = new \PagSeguroAccountCredentials(Config::get('pagseguro.user'), Config::get('pagseguro.token'));
    return $credentials;
  }

  /**
   * [paymentUrl description]
   * @param  [type] $params [description]
   * @return [type]         [description]
   */
  public function paymentUrl($params){
    $this->paymentRequest->addItem($params['Item']);
    $this->paymentRequest->setSender($params['Sender']);
    $this->paymentRequest->setShippingAddress($params['Address']);
    $this->paymentRequest->setCurrency('BRL');
    $this->paymentRequest->setShippingType(3);
    $this->paymentRequest->setReference($params['reference']);
    $this->paymentRequest->addParameter('notificationURL', route('pagseguro.notification'));
    $this->paymentRequest->setRedirectURL(route('panel.main'));

    return $this->paymentRequest->register($this->credentials());
  }
}