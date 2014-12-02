<div class="topologin grid_16">
    <span>
        {{link_to(url(), "IX JIRS")}}
    </span>
    @if (Auth::check())
    <span style="float:right">
        {{Session::get('nome')}}
        {{link_to('/panel/logout', 'Sair', ['class' => 'alpha'])}}
    </span>
    @endif
</div>
<div class="grid_16" id="topo">
    <h1>{{$title}}</h1>
</div>