<div class="topologin grid_16">
    <span>
        {{link_to_route('home', 'IX JIRS')}}
    </span>
    @if (Auth::check())
    <span style="float:right">
        {{Session::get('nome')}}
        {{link_to('/admin/logout', 'Sair', ['class' => 'alpha'])}}
    </span>
    @endif
</div>
<div class="grid_16" id="topo">
    <h1>{{$title}}</h1>
</div>