@extends('layouts.admin.cms')

@section('content')
	<div class="grid_11">
		@if (Session::has('success'))
			<div class="message message-success">
				{{Session::get('success')}}
			</div>
			<?php Session::forget('success')  ?>
		@endif

		@if (Session::has('error'))
			<div class="message message-error">
				{{Session::get('error')}}
			</div>
			<?php Session::forget('error')  ?>
		@endif
		{{ Form::open(array('url' => "admin/noticias/{$slug}/editar")) }}
			<div class="admin-navigation clearfix">
				<div class="grid_1 alpha">
					<a href="{{url('admin/noticias')}}" class="btn">Voltar</a>
				</div>
				<div class="grid_9">&nbsp;</div>
				<div class="grid_1 omega">
					<button class="btn btn-save">Salvar</button>
				</div>
			</div>
			<h1>Edição da notícia: {{$posts['pt']['title']}}</h1>
			@foreach ([['Português', 'pt'], ['Inglês', 'en'], ['Francês', 'fr']] as $lang)
			<div>
				<h2>Texto em {{$lang[0]}}</h2>
				<p>{{Form::text("{$lang[1]}[title]", $posts[$lang[1]]['title'], ['style' => 'width:98%; padding:1%'])}}</p>
			    <p>{{Form::textarea("{$lang[1]}[content]", $posts[$lang[1]]['content'])}}</p>
			</div>
		    @endforeach
		{{ Form::close() }}
    </div>
@stop

@section('scripts-footer')
	<script src="{{asset('js/tinymce/jquery.tinymce.min.js')}}"></script>
	<script src="{{asset('js/tinymce/tinymce.min.js')}}"></script>
	<script>
		tinymce.init({
		    selector: "textarea",
		    language_url : '{{asset("js/tinymce/langs/pt_BR.js")}}',
		    plugins: "table image link code media textcolor",
    		tools: "inserttable",
		    toolbar: ["bold italic  forecolor backcolor | alignleft aligncenter alignright alignjustify | fontsizeselect formatselect | bullist numlist outdent indent | table link code | image media"],
		    menu: []
		 });
	</script>
@stop