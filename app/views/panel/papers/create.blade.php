@extends('layouts.panel.profile')

@section('content')
    <div class="grid_11">
        @if (Session::has('server'))
            <div class="admin">
                <p class="message message-success">{{ Session::get('server') }}</p>
            </div>
        @endif

        {{ Form::open(["route" => ['papers.submit'], "class" => "subscriptionForm", 'method'=> 'POST', "files" => true]) }}
            <h1>@lang('papers.titles.main')</h1>
            <h3>@lang('papers.titles.data')</h3>
            {{ Form::hidden('language', $lang)}}
            <div class="grid_4 alpha {{ $errors->has('tipo_trabalho') ? 'validation-error' : '' }}">
                {{ Form::label('tipo_trabalho', trans('papers.tipo_trabalho')) }}
                {{ Form::select('tipo_trabalho', Helpers\PapersHelper::choices(), ''); }}
            </div>
            <div class="grid_7 alpha {{ $errors->has('eixo_tematico') ? 'validation-error' : '' }}">
                {{ Form::label('eixo_tematico', trans('papers.eixo_tematico')) }}
                {{ Form::select('eixo_tematico', Helpers\PapersHelper::axesChoices(), ''); }}
            </div>
            <div class="clearfix"></div>
            <div class="{{ $errors->has('titulo') ? 'validation-error' : '' }}">
                {{ Form::label('titulo', trans('papers.titulo')) }}
                {{ Form::text('titulo') }}
            </div>
            <div class="{{ $errors->has('autor') ? 'validation-error' : '' }}">
                {{ Form::label('autor', trans('papers.autor')) }}
                {{ Form::text('autor', $user->nome, ['disabled' => 'disabled']) }}
                {{ Form::hidden('autor', $user->id) }}
            </div>
            <div class="{{ $errors->has('co_autor_1') ? 'validation-error' : '' }}">
                {{ Form::label('co_autor_1', trans('papers.co_autor_1')) }}
                {{ Form::text('co_autor_1') }}
            </div>
            <div class="{{ $errors->has('co_autor_2') ? 'validation-error' : '' }}">
                {{ Form::label('co_autor_2', trans('papers.co_autor_2')) }}
                {{ Form::text('co_autor_2') }}
            </div>
            <div class="{{ $errors->has('co_autor_3') ? 'validation-error' : '' }}">
                {{ Form::label('co_autor_3', trans('papers.co_autor_3')) }}
                {{ Form::text('co_autor_3') }}
            </div>
            <br>
            <fieldset>
                <h3>{{trans('papers.titles.arquivos')}}</h3>
                <div class="{{ $errors->has('arquivo_identificado') ? 'validation-error' : '' }}">
                    {{ Form::label('arquivo_identificado', trans('papers.arquivo_identificado')) }}
                    {{ Form::file('arquivo_identificado') }}
                    <br/><small>@lang('papers.pdf.message')</small>
                </div>
                <div class="{{ $errors->has('arquivo_identificado') ? 'validation-error' : '' }}">
                    {{ Form::label('arquivo_nao_identificado', trans('papers.arquivo_nao_identificado')) }}
                    {{ Form::file('arquivo_nao_identificado') }}
                    <br/><small>@lang('papers.pdf.message')</small>
                </div>
            </fieldset>

            {{ Form::submit(trans('papers.enviar'), ['style' => 'float:right', 'class' => 'btn']) }}

        {{ Form::close() }}
    </div>
@stop