@extends('layouts.panel.profile')

@section('content')
<div class="grid_11">
  <div class="payment-box">
    <h1>Pagamento pendente</h1>
    <p>Caso já tenha pago, por favor, aguarde o período de até 3 (três) dias úteis para que seja dado baixa. Caso já tenha passado os 3 dias úteis, entre em contato para que verifiquemos sua situação.</p>
    {{ Form::open(['route' => ['payment'], 'method' => "POST"]) }}
      <input type="hidden" name="cpf" value="{{$user->cpf}}">
      <input type="hidden" name="participacao" value="{{$user->profissao}}">
      <button type="submit" name="type" value="pagseguro" class="btn">Pagar com PagSeguro</a>
    {{Form::close()}}
  </div>
</div>
@stop