@extends('layouts.admin.cms')

@section('content')
	<h1>Inscrições</h1>
  <h2>{{ $participation->nome }}</h2>

  @if (count($participation->inscricaoEventos))
    <table>
      <tbody>
        <tr>
          <td><strong>#</strong></td>
          <td><strong>CPF</strong></td>
          <td><strong>Nome</strong></td>
          <td><strong>Pago</strong></td>
          <td><strong>&nbsp;</strong></td>
        </tr>
  	  @foreach ($participation->inscricaoEventos as $p)
        <tr>
          <td>{{ $p->id }}</td>
          <td>{{ $p->user->cpf }}</td>
          <td>{{ $p->user->nome }}</td>
          <td>{{ \Helpers\Subscription::paymentStatus($p->contasReceber->id_situacao) }}</td>
          <td><a href="{{url('admin/inscricoes/inscricao', $p->id)}}">Visualizar inscrição</a></td>
        </tr>
      @endforeach
      </tbody>
    </table>
  @else
    <p>Não há inscrições</p>
  @endif
@stop