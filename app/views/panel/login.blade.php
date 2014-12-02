@extends('layouts.panel.login')

@section('content')
	<div class="grid_6">&nbsp;</div>
	<div class="grid_4">
		{{ Form::open(["route"=>"user.login", "method" => "POST"]) }}
			<div>
				<strong>{{Form::label('E-mail')}}</strong><br/>
				{{Form::text('email')}}
			</div>
			<div>
				<strong>{{Form::label('Senha')}}</strong><br/>
				{{Form::password('password')}}
			</div>
			{{Form::submit('Acessar')}}
		{{ Form::close() }}
	</div>
	<div class="grid_6">&nbsp;</div>
@stop