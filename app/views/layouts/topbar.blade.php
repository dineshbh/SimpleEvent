<div class="topologin grid_16">
    <!-- <form action="./site/public/sistema/login.php?url=index.php" method="post"> -->
    {{ Form::open(["route"=>"user.login", "method" => "POST"]) }}
        <span>@lang('topbar.login')</span>
        <input type="text" name="email" placeholder="@lang('topbar.email')"/>
        <input type="password" name="password" minlength="8" placeholder="@lang('topbar.senha')"/>
        <input type="hidden" name="tipo" value="part" />
        <input type="hidden" name="idioma_site" value="{{$lang}}" />
        <input type="submit" value="ok"/>
        <div class="clear"></div>
        <div id="lembrar_senha"><a href="#">@lang('topbar.esqueci')</a></div>
    {{ Form::close() }}
    <div id="dialog_lembrar_senha" title="@lang('topbar.esqueci')">
        <p>@lang('topbar.resetar')</p>
        {{ Form::open(['route' => ['recovery'], 'method' => "POST", 'id' => 'recovery']) }}
            <input type="text" name="email_recuperar" id="email_recuperar" size="50" placeholder="@lang('topbar.email')"/>
            <input type="hidden" id="idioma_site" name="idioma_site" value="{{$lang}}" />
            <div id='resposta_senha'>
                <div class="sucesso" style="display: none">@lang('topbar.sucesso')</div>
                <div class="erro" style="display: none;">@lang('topbar.nao_registrado')</div>
            </div>
        {{Form::close()}}
    </div>
    <?php $slug = Request::segment(2); $last = Request::segment(3); ?>
    <a href="{{ url("pt/" . Helpers\I18nHelper::trans($lang, 'pt', $slug, $last)) }}"><img src="{{ asset('css/images/flagptpq.gif') }}" alt="pt" /></a>
    <a href="{{ url("fr/" . Helpers\I18nHelper::trans($lang, 'fr', $slug, $last)) }}"><img src="{{ asset('css/images/flagfrpq.gif') }}" alt="fr" /></a>
    <a href="{{ url("en/" . Helpers\I18nHelper::trans($lang, 'en', $slug, $last)) }}"><img src="{{ asset('css/images/flagenpq.gif') }}" alt="en" /></a>
</div>
<div class="grid_16" id="topo">
    <div class="grid_16 logo alpha" style="background:url({{ asset('css/images/logo.png') }}) no-repeat;">
        <h1>@lang('topbar.titulo')</h1>
    </div>
</div>