@extends('layouts.panel.profile')

@section('content')
<div class="grid_11">
  <h1>{{ $title }}</h1>
  <p>{{link_to_route('papers.submit', 'Enviar trabalho', null, ['class' => 'btn'])}}</p>

  @if (Session::has('success'))
    <div class="admin">
        <p class="message message-success">{{ Session::get('success') }}</p>
    </div>
  @endif

  @foreach ($papers as $p)
  <div class="trabalhos">
    <div class="trabalhos__meta">
      <span><strong>Código:</strong> {{str_pad($p->id, 6, 0, STR_PAD_LEFT)}}</span>
      <span><strong>Título:</strong> {{$p->titulo}}</span>
      <span><strong>Idioma:</strong> {{Helpers\PapersHelper::language($p->language)}}</span>
      <span><strong>Tipo:</strong> {{Helpers\PapersHelper::choiceText($p->tipo_trabalho)}}</span>
      <span><strong>Autor:</strong> {{$p->autor}}</span>
      <span><strong>Co-Autores:</strong><span class="trabalhos__inner">
        @if (count($p->coAuthors))
          @foreach ($p->coAutor as $c)
            {{$c->nome}},
          @endforeach
        @endif
      </span></span>
      <span><strong>Eixo Temático:</strong> {{Helpers\PapersHelper::axisText($p->eixo_tematico)}}</span></span>
      <span><strong>Arquivos:</strong>
      <a href="{{asset('storage/uploads/' . $p->arquivo_identificado)}}">Arquivo Identificado</a>, <a href="{{asset('storage/uploads/' . $p->arquivo_nao_identificado)}}">Arquivo Não Identificado</a>
      </span>
    </div>
  </div>
  @endforeach
</div>
@stop