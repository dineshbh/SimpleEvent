@extends('layouts.basic')

@section('content')
	<div class="grid_11">
		<h1>{{$content['title']}}</h1>
		<p>{{$content['content']}}</p>
    </div>
@stop