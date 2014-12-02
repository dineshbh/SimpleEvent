@extends('layouts.panel.profile')

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
        @if (Session::has('signupsuccess'))
            <div class="admin">
                <p class="message message-success">Inscrição realizada com sucesso</p>
            </div>
        @endif
        @if (Session::has('updatesuccess'))
            <div class="admin">
                <p class="message message-success">Dados atualizados com sucesso</p>
            </div>
        @endif
        <div class="payment-box">
            <?php
            /*@if (!$paid OR $paid->id_situacao != 2)
                <h1>Selecione sua forma de pagamento</h1>
                {{ Form::open(['route' => ['payment'], 'method' => "POST"]) }}
                    <input type="hidden" name="cpf" value="{{$user->cpf}}">
                    <input type="hidden" name="participacao" value="{{$user->profissao}}">
                    <button type="submit" name="type" value="billet" class="btn" target="_blank">Pagar com Boleto</a>
                    <button type="submit" name="type" value="pagseguro" class="btn">Pagar com PagSeguro</a>
                {{Form::close()}}
            @endif*/
            ?>
        </div>
        {{ Form::open(["route" => ['user.update'], 'method'=> 'POST', "class" => "subscriptionForm", "files" => true]) }}
            <h2>@lang('subscription.dados')</h2>
            {{ Form::hidden('language', $lang)}}
            <div class="{{ $errors->has('dadosPessoais.nome') ? 'validation-error' : '' }}">
                {{ Form::label('dadosPessoais[nome]', trans('subscription.nome')) }}
                {{ Form::text('dadosPessoais[nome]', $user->nome) }}
                <small>@lang('subscription.nome-descricao')</small>
            </div>
            <div class="clearfix"></div>

            @if ($lang === 'pt')
            <div class="grid_3 alpha {{ $errors->has('dadosPessoais.cpf') ? 'validation-error' : '' }}">
                {{ Form::label('dadosPessoais[cpf]', trans('subscription.cpf')) }}
                {{ Form::text('dadosPessoais[cpf]', $user->cpf, ['class' => "cpf"]) }}
            </div>
            <div class="grid_4 {{ $errors->has('dadosPessoais.rg') ? 'validation-error' : '' }}">
                {{ Form::label('dadosPessoais[rg]', trans('subscription.rg')) }}
                {{ Form::text('dadosPessoais[rg]', $user->rg) }}
            </div>
            @endif
            @if ($lang !== 'pt')
            <div class="grid_4 alpha {{ $errors->has('dadosPessoais.passaporte') ? 'validation-error' : '' }}">
            @else
            <div class="grid_4 omega {{ $errors->has('dadosPessoais.passaporte') ? 'validation-error' : '' }}">
            @endif
                {{ Form::label('dadosPessoais[passaporte]', trans('subscription.passaporte')) }}
                {{ Form::text('dadosPessoais[passaporte]', $user->passaporte) }}
            </div>
            <div class="clearfix"></div>
            <div class="grid_3 alpha {{ $errors->has('dadosPessoais.senha') ? 'validation-error' : '' }}">
                {{ Form::label('dadosPessoais[senha_antiga]', trans('subscription.senha_antiga')) }}
                {{ Form::password('dadosPessoais[senha_antiga]') }}
                <small>@lang('subscription.senha-descricao-3')</small>
            </div>
            <div class="grid_4 {{ $errors->has('dadosPessoais.senha') ? 'validation-error' : '' }}">
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
                {{ Form::text('dadosPessoais[nascimento]', \Helpers\Dates::humanize($user->data_nascimento), ['class' => "data"]) }}
                <small>@lang('subscription.birth')</small>
            </div>
            <div class="grid_4 {{ $errors->has('dadosPessoais.telefoneFixo') ? 'validation-error' : '' }}">
                {{ Form::label('dadosPessoais[telefoneFixo]', trans('subscription.telefone-fixo')) }}
                {{ Form::text('dadosPessoais[telefoneFixo]', $user->telefone) }}
                <small>@lang('subscription.telefone-descricao')</small>
            </div>
            <div class="grid_4 omega {{ $errors->has('dadosPessoais.telefoneCelular') ? 'validation-error' : '' }}">
                {{ Form::label('dadosPessoais[telefoneCelular]', trans('subscription.telefone-celular')) }}
                {{ Form::text('dadosPessoais[telefoneCelular]', $user->celular) }}
                <small>@lang('subscription.telefone-descricao')</small>
            </div>
            <div class="clearfix"></div>

            <div class="{{ $errors->has('dadosPessoais.instituicao') ? 'validation-error' : '' }}">
                {{ Form::label('dadosPessoais[instituicao]', trans('subscription.instituicao')) }}
                {{ Form::text('dadosPessoais[instituicao]', $user->instituicao) }}
            </div>
            <div class="{{ $errors->has('dadosPessoais.email') ? 'validation-error' : '' }}">
                {{ Form::label('dadosPessoais[email]', trans('subscription.email')) }}
                {{ Form::text('dadosPessoais[email]', $user->email) }}
            </div>
            <div class="clearfix"></div>

            <div class="grid_3 alpha {{ $errors->has('dadosPessoais.perfil') ? 'validation-error' : '' }}">
                {{ Form::label('dadosPessoais[perfil]', trans('subscription.perfil')) }}
                {{ Form::select('dadosPessoais[perfil]', Helpers\Subscription::choices(), $user->profissao, ['disabled' => 'disabled']); }}
                <input type="hidden" name="dadosPessoais[perfil]" value="{{$user->profissao}}">
            </div>
            <div class="grid_8 omega {{ $errors->has('dadosPessoais.comprovanteMatricula') ? 'validation-error' : '' }}">
                {{ Form::label('dadosPessoais[comprovanteMatricula]', trans('subscription.comprovante')) }}
                @if ($user->formado)
                {{ link_to_asset($user->formado) }}
                @else
                {{ Form::file('dadosPessoais[comprovanteMatricula]'); }}
                @endif
            </div>
            <div class="clearfix"></div>

            <h2>@lang('subscription.endereco')</h2>
            <div class="{{ $errors->has('dadosPessoais.endereco') ? 'validation-error' : '' }}">
                {{ Form::label('dadosPessoais[endereco]', trans('subscription.endereco')) }}
                {{ Form::text('dadosPessoais[endereco]', $user->endereco) }}
                <small>@lang('subscription.endereco-descricao')</small>
            </div>

            @if ($lang === 'pt')
            <div class="grid_4 alpha {{ $errors->has('dadosPessoais.bairro') ? 'validation-error' : '' }}">
                {{ Form::label('dadosPessoais[bairro]', trans('subscription.bairro')) }}
                {{ Form::text('dadosPessoais[bairro]', $user->bairro) }}
            </div>
            <div class="grid_5 {{ $errors->has('dadosPessoais.cidade') ? 'validation-error' : '' }}">
                {{ Form::label('dadosPessoais[cidade]', trans('subscription.cidade')) }}
                {{ Form::text('dadosPessoais[cidade]', $user->cidade) }}
            </div>
            <div class="grid_2 omega {{ $errors->has('dadosPessoais.cep') ? 'validation-error' : '' }}">
                {{ Form::label('dadosPessoais[cep]', trans('subscription.cep')) }}
                {{ Form::text('dadosPessoais[cep]', $user->cep, ['class' => 'cep']) }}
            </div>
            <div class="clearfix"></div>
            @endif

            @if (in_array($lang, ['en', 'fr']))
            <div class="grid_4 alpha {{ $errors->has('dadosPessoais.zip') ? 'validation-error' : '' }}">
                {{ Form::label('dadosPessoais[zip]', trans('subscription.zip')) }}
                {{ Form::text('dadosPessoais[zip]', $user->zipcode) }}
            </div>
            <div class="grid_3 {{ $errors->has('dadosPessoais.estado') ? 'validation-error' : '' }}">
            @else
            <div class="grid_6 alpha {{ $errors->has('dadosPessoais.estado') ? 'validation-error' : '' }}">
            @endif
                {{ Form::label('dadosPessoais[estado]', trans('subscription.estado')) }}
                {{ Form::text('dadosPessoais[estado]', $user->uf) }}
            </div>
            @if (in_array($lang, ['en', 'fr']))
            <div class="grid_4 omega {{ $errors->has('dadosPessoais.pais') ? 'validation-error' : '' }}">
            @else
            <div class="grid_5 omega {{ $errors->has('dadosPessoais.pais') ? 'validation-error' : '' }}">
            @endif
                {{ Form::label('dadosPessoais[pais]', trans('subscription.pais')) }}
                {{ Form::text('dadosPessoais[pais]', $user->pais) }}
            </div>
            <div class="clearfix"></div>

            <div class="{{ $errors->has('dadosPessoais.jantar') ? 'validation-error' : '' }}">
                {{ Form::label('dadosPessoais[jantar]', trans('subscription.jantar')) }}
                @if ($user->jantar == 'S')
                {{ Form::radio('dadosPessoais[jantar]', 'S', true, ['disabled' => 'disabled']) }} @lang('subscription.jantar-sim')
                {{ Form::radio('dadosPessoais[jantar]', 'N') }} @lang('subscription.jantar-nao')
                @else
                {{ Form::radio('dadosPessoais[jantar]', 'S') }} @lang('subscription.jantar-sim')
                {{ Form::radio('dadosPessoais[jantar]', 'N', true, ['disabled' => 'disabled']) }} @lang('subscription.jantar-nao')
                <input type="hidden" name="dadosPessoais[jantar]" value="{{$user->jantar}}">
                @endif
            </div>

            {{ Form::submit(trans('subscription.edicao'), ['style' => 'float:right', 'class' => 'btn']) }}

        {{ Form::close() }}
    </div>
@stop