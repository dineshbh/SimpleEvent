<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8" />
        <meta name="title" content="IX JIRS" />
        <meta name="keywords" content="ix jirs, jirs, uninovafapi, novafapi, evento, internacional" />
        <meta name="description" content="IX JIRS" />

        <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
        <meta name="description" content="" />
        <meta name="viewport" content="width=device-width" />
        <title>Login Painel do Congressista - IX JIRS</title>
        <link href="{{ asset('css/reset.css') }}" media="screen" rel="stylesheet" type="text/css" />
        <link href="{{ asset('css/960_16_col.css') }}" media="screen" rel="stylesheet" type="text/css" />
        <link href="{{ asset('jquery-ui-custom/css/cirs-theme/jquery-ui-1.9.2.custom.css') }}" media="screen" rel="stylesheet" type="text/css" />
        <link href="{{ asset('css/style.css') }}" media="screen" rel="stylesheet" type="text/css" />
    </head>

    <body class="admin">
        <div class="topoBg"></div>
        <!--CONTENT-->
        <div class="container_16 ">

             @include('layouts.panel.topbar', ['title' => $title])

            <!--CONTEÚDO-->
            <div class="grid_16" id="conteudo">
                @yield('content')
            </div><!--/CONTEÚDO-->

            <!--BASE-->
            <div class="grid_16" id="base">
                <div class="grid_8 apoio alpha omega" style="background: url({{ asset('css/images/apoios_en.png') }}) no-repeat;"></div>
            </div>
            <!--/base-->
        </div>
        <!--/content-->

        {{-- @include('layouts.admin.aside') --}}

        <script type="text/javascript">
        //<![CDATA[
        var FECHAR = "@lang('topbar.fechar')";
        var ENVIAR = "@lang('topbar.enviar')";
        var BASE_URL = "/site";
        //]]>
        </script>
        <script type="text/javascript" src="http://code.jquery.com/jquery-1.9.1.js"></script>
        <script type="text/javascript" src="{{ asset('jquery-ui-custom/js/jquery-ui-1.9.2.custom.js') }}"></script>
        <script type="text/javascript" src="http://maps.google.com/maps/api/js?sensor=true"></script>
        <script type="text/javascript" src="{{ asset('js/jquery.maskedinput.min.js') }}"></script>
        <script type="text/javascript" src="{{ asset('js/jquery.validate.min.js') }}"></script>
        <script type="text/javascript" src="{{ asset('js/main.js') }}"></script>
        <script type="text/javascript" src="{{ asset('js/site.js') }}"></script>
        @yield('scripts-footer')
    </body>
</html>
