@extends('layouts.basic')

@section('content')
    <div class="grid_11">
        @if ($errors->has('dadosPessoais'))
            <div class="admin">
                <p class="message message-error">Os campos em vermelho precisam ser preenchidos corretamente</p>
            </div>
        @endif
        @if (Session::has('message'))
            <div class="admin">
                <p class="message message-error">{{ Session::get('message') }}</p>
            </div>
        @endif
        <h1>@lang('subscription.ficha')</h1>
        {{ Form::open(array("url" => "signup", "class" => "subscriptionForm", "files" => true)) }}
            <h2>@lang('subscription.dados')</h2>
            {{ Form::hidden('language', $lang)}}
            <div class="{{ $errors->has('dadosPessoais.nome') ? 'validation-error' : '' }}">
                {{ Form::label('dadosPessoais[nome]', trans('subscription.nome')) }}
                {{ Form::text('dadosPessoais[nome]') }}
                <small>@lang('subscription.nome-descricao')</small>
            </div>
            <div class="clearfix"></div>

            @if ($lang === 'pt')
            <div class="grid_3 alpha {{ $errors->has('dadosPessoais.cpf') ? 'validation-error' : '' }}">
                {{ Form::label('dadosPessoais[cpf]', trans('subscription.cpf')) }}
                {{ Form::text('dadosPessoais[cpf]', null, ['class' => "cpf"]) }}
            </div>
            <div class="grid_4 {{ $errors->has('dadosPessoais.rg') ? 'validation-error' : '' }}">
                {{ Form::label('dadosPessoais[rg]', trans('subscription.rg')) }}
                {{ Form::text('dadosPessoais[rg]') }}
            </div>
            @endif
            @if ($lang !== 'pt')
            <div class="grid_4 alpha {{ $errors->has('dadosPessoais.passaporte') ? 'validation-error' : '' }}">
            @else
            <div class="grid_4 omega {{ $errors->has('dadosPessoais.passaporte') ? 'validation-error' : '' }}">
            @endif
                {{ Form::label('dadosPessoais[passaporte]', trans('subscription.passaporte')) }}
                {{ Form::text('dadosPessoais[passaporte]') }}
            </div>
            <div class="clearfix"></div>

            <div class="grid_4 alpha {{ $errors->has('dadosPessoais.senha') ? 'validation-error' : '' }}">
                {{ Form::label('dadosPessoais[senha]', trans('subscription.senha')) }}
                {{ Form::password('dadosPessoais[senha]') }}
                <small>@lang('subscription.senha-descricao-1')</small>
            </div>
            <div class="grid_4 omega {{ $errors->has('dadosPessoais.confirmarSenha') ? 'validation-error' : '' }}">
                {{ Form::label('dadosPessoais[confirmarSenha]', trans('subscription.senha-confirma')) }}
                {{ Form::password('dadosPessoais[confirmarSenha]') }}
                <small>@lang('subscription.senha-descricao-2')</small>
            </div>
            <div class="clearfix"></div>

            <div class="grid_3 alpha {{ $errors->has('dadosPessoais.nascimento') ? 'validation-error' : '' }}">
                {{ Form::label('dadosPessoais[nascimento]', trans('subscription.nascimento')) }}
                {{ Form::text('dadosPessoais[nascimento]', null, ['class' => "data"]) }}
            </div>
            <div class="grid_4 {{ $errors->has('dadosPessoais.telefoneFixo') ? 'validation-error' : '' }}">
                {{ Form::label('dadosPessoais[telefoneFixo]', trans('subscription.telefone-fixo')) }}
                {{ Form::text('dadosPessoais[telefoneFixo]') }}
                <small>@lang('subscription.telefone-descricao')</small>
            </div>
            <div class="grid_4 omega {{ $errors->has('dadosPessoais.telefoneCelular') ? 'validation-error' : '' }}">
                {{ Form::label('dadosPessoais[telefoneCelular]', trans('subscription.telefone-celular')) }}
                {{ Form::text('dadosPessoais[telefoneCelular]') }}
                <small>@lang('subscription.telefone-descricao')</small>
            </div>
            <div class="clearfix"></div>

            <div class="{{ $errors->has('dadosPessoais.instituicao') ? 'validation-error' : '' }}">
                {{ Form::label('dadosPessoais[instituicao]', trans('subscription.instituicao')) }}
                {{ Form::text('dadosPessoais[instituicao]') }}
            </div>
            <div class="{{ $errors->has('dadosPessoais.email') ? 'validation-error' : '' }}">
                {{ Form::label('dadosPessoais[email]', trans('subscription.email')) }}
                {{ Form::text('dadosPessoais[email]') }}
            </div>
            <div class="{{ $errors->has('dadosPessoais.confirmarEmail') ? 'validation-error' : '' }}">
                {{ Form::label('dadosPessoais[confirmarEmail]', trans('subscription.email-confirma')) }}
                {{ Form::text('dadosPessoais[confirmarEmail]') }}
            </div>
            <div class="clearfix"></div>

            <div class="grid_3 alpha {{ $errors->has('dadosPessoais.perfil') ? 'validation-error' : '' }}">
                {{ Form::label('dadosPessoais[perfil]', trans('subscription.perfil')) }}
                {{ Form::select('dadosPessoais[perfil]', Helpers\Subscription::choices(), ''); }}
            </div>
            <div class="grid_8 omega {{ $errors->has('dadosPessoais.comprovanteMatricula') ? 'validation-error' : '' }}">
                {{ Form::label('dadosPessoais[comprovanteMatricula]', trans('subscription.comprovante')) }}
                {{ Form::file('dadosPessoais[comprovanteMatricula]'); }}
            </div>
            <div class="clear_fix"></div>

            <h2>@lang('subscription.endereco')</h2>
            <div class="{{ $errors->has('dadosPessoais.endereco') ? 'validation-error' : '' }}">
                {{ Form::label('dadosPessoais[endereco]', trans('subscription.endereco')) }}
                {{ Form::text('dadosPessoais[endereco]') }}
                <small>@lang('subscription.endereco-descricao')</small>
            </div>

            @if ($lang === 'pt')
            <div class="grid_4 alpha {{ $errors->has('dadosPessoais.bairro') ? 'validation-error' : '' }}">
                {{ Form::label('dadosPessoais[bairro]', trans('subscription.bairro')) }}
                {{ Form::text('dadosPessoais[bairro]') }}
            </div>
            <div class="grid_5 {{ $errors->has('dadosPessoais.cidade') ? 'validation-error' : '' }}">
                {{ Form::label('dadosPessoais[cidade]', trans('subscription.cidade')) }}
                {{ Form::text('dadosPessoais[cidade]') }}
            </div>
            <div class="grid_2 omega {{ $errors->has('dadosPessoais.cep') ? 'validation-error' : '' }}">
                {{ Form::label('dadosPessoais[cep]', trans('subscription.cep')) }}
                {{ Form::text('dadosPessoais[cep]', null, ['class' => 'cep']) }}
            </div>
            <div class="clearfix"></div>
            @endif

            @if (in_array($lang, ['en', 'fr']))
            <div class="grid_4 alpha {{ $errors->has('dadosPessoais.zip') ? 'validation-error' : '' }}">
                {{ Form::label('dadosPessoais[zip]', trans('subscription.zip')) }}
                {{ Form::text('dadosPessoais[zip]') }}
            </div>
            <div class="grid_3 {{ $errors->has('dadosPessoais.estado') ? 'validation-error' : '' }}">
            @else
            <div class="grid_6 alpha {{ $errors->has('dadosPessoais.estado') ? 'validation-error' : '' }}">
            @endif
                {{ Form::label('dadosPessoais[estado]', trans('subscription.estado')) }}
                {{ Form::text('dadosPessoais[estado]') }}
            </div>
            @if (in_array($lang, ['en', 'fr']))
            <div class="grid_4 omega {{ $errors->has('dadosPessoais.pais') ? 'validation-error' : '' }}">
            @else
            <div class="grid_5 omega {{ $errors->has('dadosPessoais.pais') ? 'validation-error' : '' }}">
            @endif
                {{ Form::label('dadosPessoais[pais]', trans('subscription.pais')) }}
                {{ Form::text('dadosPessoais[pais]') }}
            </div>
            <div class="clearfix"></div>

            <!-- <div class="{{ $errors->has('dadosPessoais.jantar') ? 'validation-error' : '' }}">
                {{ Form::label('dadosPessoais[jantar]', trans('subscription.jantar')) }}
                {{ Form::radio('dadosPessoais[jantar]', 'S') }} @lang('subscription.jantar-sim')
                {{ Form::radio('dadosPessoais[jantar]', 'N', true) }} @lang('subscription.jantar-nao')
            </div> -->

            {{ Form::submit(trans('subscription.inscricao'), ['style' => 'float:right', 'class' => 'btn']) }}

        {{ Form::close() }}
    </div>
@stop