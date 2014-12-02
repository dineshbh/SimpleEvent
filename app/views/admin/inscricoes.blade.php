@extends('layouts.admin.cms')

@section('content')
	<h1>Inscrições</h1>

  @if ($participations)
    <table>
      <tbody>
        <tr>
          <td><strong>Tipo</strong></td>
          <td><strong>Qtd.</strong></td>
          <td><strong>Ações</strong></td>
        </tr>
  	  @foreach ($participations as $p)
        <tr>
          <td style="text-align:left">{{ $p->nome }}</td>
          <td>{{ count($p->inscricaoEventos) }}</td>
          <!-- <td>{{ $p->id }}</td> -->
          <td><a href="{{url('admin/inscricoes', $p->id)}}">Visualizar inscrições</a></td>
        </tr>
      @endforeach
      </tbody>
    </table>
  @else
    <p>Não há inscrições</p>
  @endif
@stop