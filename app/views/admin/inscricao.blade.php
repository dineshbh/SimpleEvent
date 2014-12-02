@extends('layouts.admin.cms')

@section('content')
	<h1>Inscrições</h1>
  <h2>{{ $inscrito->participacaoEvento[0]->nome }}</h2>


  <table>
    <tbody>
      <tr>
        <td><strong>#</strong></td>
        <td><strong>CPF</strong></td>
        <td><strong>Nome</strong></td>
        <td><strong>Pago</strong></td>
        <td><strong>&nbsp;</strong></td>
      </tr>
      <tr>
        <td>{{ $inscrito->id }}</td>
        <td>{{ $inscrito->user->cpf }}</td>
        <td>{{ $inscrito->user->nome }}</td>
        <td>{{ \Helpers\Subscription::paymentStatus($inscrito->contasReceber->id_situacao) }}</td>
        <td></td>
      </tr>
    </tbody>
  </table>
@stop