@extends('layouts.admin.cms')

@section('content')
	<h1>Trabalhos</h1>
  <div class="grid_11">
    @if (\Session::has('status'))
      <div class="admin">
        @if (\Session::get('status'))
          <p class="message message-success">Alteração de estado do trabalho para <em>Aceito</em> com sucesso</p>
        @else
          <p class="message message-error">Alteração de estado do trabalho para <em>Rejeitado</em> com sucesso</p>
        @endif
      </div>
    @endif
    <table>
      <tr>
        <td>#</td>
        <td>Título</td>
        <td>Autor</td>
        <td>Tipo/Eixo</td>
        <td>Situação</td>
      </tr>
      @foreach($papers as $p)
        <tr>
          <td><a href="{{route('admin.papers.edit', ['id' => $p->id])}}">{{str_pad($p->id, 6, 0, STR_PAD_LEFT)}}</a></td>
          <td style="text-align:left"><a href="{{route('admin.papers.edit', ['id' => $p->id])}}">{{$p->titulo}}</a> <br/> <small>{{$p->palavras_chave}}</small></td>
          <td>{{$p->author->nome}}</td>
          <td style="text-align:left"><strong>Tipo</strong>: <em>{{\Helpers\PapersHelper::choiceText($p->tipo_trabalho)}}</em> <br/> <strong>Eixo</strong>: <em>{{\Helpers\PapersHelper::axisText($p->eixo_tematico)}}</em></td>
          <td>{{\Helpers\PapersHelper::status($p->aceito)}}<br/>
          {{Form::open(["route" => ['admin.papers.status'], "class" => "subscriptionForm", 'method'=> 'POST'])}}
          {{Form::hidden('aceito', true)}}
          {{Form::hidden('id', $p->id)}}
          {{Form::submit('Aceitar', ['class' => 'btn btn-save'])}}
          {{Form::close()}}

          {{Form::open(["route" => ['admin.papers.status'], "class" => "subscriptionForm", 'method'=> 'POST'])}}
          {{Form::hidden('aceito', false)}}
          {{Form::hidden('id', $p->id)}}
          {{Form::submit('Rejeitar', ['class' => 'btn'])}}
          {{Form::close()}}
          </td>
        </tr>
      @endforeach
    </table>
  </div>
@stop