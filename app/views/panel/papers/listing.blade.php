@extends('layouts.panel.profile')

@section('content')
<div class="grid_11">
  <h1>{{ $title }}</h1>
  <p>{{link_to_route('papers.submit', 'Enviar trabalho', null, ['class' => 'btn'])}}</p>

  <div class="trabalhos">
    <div class="trabalhos__meta">
      <span><strong>Código:</strong> 000000</span>
      <span><strong>Título:</strong> Representações Sociais da Infecção hospitalar por enfermeiro</span>
      <span><strong>Idioma:</strong> Português</span>
      <span><strong>Tipo:</strong> Sessão Interativa de Pôster</span>
      <span><strong>Autor:</strong> Maria Eliete Batista Moura</span>
      <span><strong>Co-Autores:</strong><span class="trabalhos__inner">Cristina Maria Miranda de Sousa, Cristina Maria Miranda de Sousa,Cristina Maria Miranda de Sousa</span></span>
      <span><strong>Eixo Temático:</strong> <span class="trabalhos__inner">Saúde, cuidados de si e envelhecimento/Health, self-care, and ageing/Santé, soins et vieillissement</span></span>
    </div>
  </div>

  <div class="trabalhos">
    <div class="trabalhos__meta">
      <span><strong>Código:</strong> 000000</span>
      <span><strong>Título:</strong> Representações Sociais da Infecção hospitalar por enfermeiro</span>
      <span><strong>Idioma:</strong> Português</span>
      <span><strong>Tipo:</strong> Sessão Interativa de Pôster</span>
      <span><strong>Autor:</strong> Maria Eliete Batista Moura</span>
      <span><strong>Co-Autores:</strong><span class="trabalhos__inner">Cristina Maria Miranda de Sousa, Cristina Maria Miranda de Sousa,Cristina Maria Miranda de Sousa</span></span>
      <span><strong>Eixo Temático:</strong> <span class="trabalhos__inner">Saúde, cuidados de si e envelhecimento/Health, self-care, and ageing/Santé, soins et vieillissement</span></span>
    </div>
  </div>


</div>
@stop