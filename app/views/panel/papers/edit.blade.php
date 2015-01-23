@extends('layouts.admin.cms')

@section('content')
    <div class="grid_11">
        @if (Session::has('success'))
            <div class="admin">
                @if(Session::get('success'))
                    <p class="message message-success">Trabalho atualizado com sucesso</p>
                @else
                    <p class="message message-error">Erro ao atualizar trabalho. Caso esse problema persista, entre em contato com os coordenadores do evento</p>
                @endif
            </div>
        @endif

        {{ Form::open(["route" => ['admin.papers.edit'], "class" => "subscriptionForm", 'method'=> 'PUT']) }}
            <h1>@lang('papers.titles.main')</h1>
            <h3>@lang('papers.titles.data')</h3>
            <div class="grid_4 alpha {{ $errors->has('tipo_trabalho') ? 'validation-error' : '' }}">
                {{ Form::label('tipo_trabalho', trans('papers.tipo_trabalho')) }}
                {{ Form::select('tipo_trabalho', Helpers\PapersHelper::choices(), $paper->tipo_trabalho); }}
            </div>
            <div class="grid_7 alpha {{ $errors->has('eixo_tematico') ? 'validation-error' : '' }}">
                {{ Form::label('eixo_tematico', trans('papers.eixo_tematico')) }}
                {{ Form::select('eixo_tematico', Helpers\PapersHelper::axesChoices(), $paper->eixo_tematico); }}
            </div>
            <div class="clearfix"></div>
            <div class="{{ $errors->has('titulo') ? 'validation-error' : '' }}">
                {{ Form::label('titulo', trans('papers.titulo')) }}
                {{ Form::text('titulo', $paper->titulo) }}
            </div>
            <div class="{{ $errors->has('autor') ? 'validation-error' : '' }}">
                {{ Form::label('autor', trans('papers.autor')) }}
                {{ Form::text('autor', $paper->author->nome, ['disabled' => 'disabled']) }}
                {{ Form::hidden('autor', $paper->author->id) }}
            </div>
            <div class="{{ $errors->has('co_autor_1') ? 'validation-error' : '' }}">
                {{ Form::label('co_autor_1', trans('papers.co_autor_1')) }}
                {{ Form::text('co_autor_1', (count($paper->coAuthors)) ? $paper->coAuthors[0]->nome : '') }}
                {{ Form::hidden('co_autor_1', $paper->co_autor_1)}}
            </div>
            <div class="{{ $errors->has('co_autor_2') ? 'validation-error' : '' }}">
                {{ Form::label('co_autor_2', trans('papers.co_autor_2')) }}
                {{ Form::text('co_autor_2', (count($paper->coAuthors)) ? $paper->coAuthors[1]->nome : '') }}
                {{ Form::hidden('co_autor_2', $paper->co_autor_2)}}
            </div>
            <div class="{{ $errors->has('co_autor_3') ? 'validation-error' : '' }}">
                {{ Form::label('co_autor_3', trans('papers.co_autor_3')) }}
                {{ Form::text('co_autor_3', (count($paper->coAuthors)) ? $paper->coAuthors[2]->nome : '') }}
                {{ Form::hidden('co_autor_3', $paper->co_autor_3)}}
            </div>
            <br>
            <div class="{{ $errors->has('resumo') ? 'validation-error' : '' }}">
                {{ Form::label('resumo', trans('papers.resumo.title')) }} (<em>Total de palavras: <span class="wordCount">{{count(explode(' ', $paper->resumo))}}</span></em>)
                {{ Form::textarea('resumo', $paper->resumo, ['style' => 'width:100%', 'class' => 'resumo']) }}
                <br/><small>@lang('papers.resumo.message')</small>
            </div>
            <div class="{{ $errors->has('palavras_chave') ? 'validation-error' : '' }}">
                {{ Form::label('palavras_chave', trans('papers.resumo.palavras_chave.title')) }}
                {{ Form::text('palavras_chave', $paper->palavras_chave) }}
                <br/><small>@lang('papers.resumo.palavras_chave.message')</small>
            </div>
            <br>
                <!-- <div class="{{ $errors->has('arquivo_identificado') ? 'validation-error' : '' }}">
                    {{ Form::label('arquivo_identificado', trans('papers.arquivo_identificado')) }}
                    {{ Form::file('arquivo_identificado') }}
                    <br/><small>@lang('papers.pdf.message')</small>
                </div>
                <div class="{{ $errors->has('arquivo_identificado') ? 'validation-error' : '' }}">
                    {{ Form::label('arquivo_nao_identificado', trans('papers.arquivo_nao_identificado')) }}
                    {{ Form::file('arquivo_nao_identificado') }}
                    <br/><small>@lang('papers.pdf.message')</small>
                </div> -->
            {{ Form::hidden('id', $paper->id)}}
            {{ Form::submit(trans('papers.enviar'), ['style' => 'float:right', 'class' => 'btn sendBtn']) }}

        {{ Form::close() }}
    </div>
@stop