@extends('layouts.panel.profile')

@section('content')
    <div class="grid_11">
        {{ Form::open(["route" => ['papers.submit'], "class" => "subscriptionForm", 'method'=> 'POST', "files" => true]) }}
            <h1>@lang('subscription.ficha')</h1>
            <h2>@lang('subscription.dados')</h2>
            {{ Form::hidden('language', $lang)}}
            <div class="grid_6 alpha {{ $errors->has('tipo_trabalho') ? 'validation-error' : '' }}">
                {{ Form::label('tipo_trabalho', trans('papers.tipo_trabalho')) }}
                {{ Form::select('tipo_trabalho', Helpers\PapersHelper::choices(), ''); }}
            </div>
            <div class="clearfix"></div>

            {{ Form::submit(trans('papers.edicao'), ['style' => 'float:right', 'class' => 'btn']) }}

        {{ Form::close() }}
    </div>
@stop