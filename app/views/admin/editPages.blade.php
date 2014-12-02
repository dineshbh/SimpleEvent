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
		{{ Form::open(array('url' => "admin/paginas/{$slug}/editar")) }}
			<div class="admin-navigation clearfix">
				<div class="grid_1 alpha">
					<a href="{{url('admin/paginas')}}" class="btn">Voltar</a>
				</div>
				<div class="grid_9">&nbsp;</div>
				<div class="grid_1 omega">
					<button class="btn btn-save">Salvar</button>
				</div>
			</div>
			<h1>Edição da página: {{$name}}</h1>
			<div>
				<h2>Texto em Português</h2>
			    <p>{{Form::textarea('pt', $pages['pt'])}}</p>
			</div>
		    <div>
		    	<h2>Texto em Inglês</h2>
		    	<p>{{Form::textarea('en', $pages['en'])}}</p>
		    </div>
		    <div>
		    	<h2>Texto em Francês</h2>
		    	<p>{{Form::textarea('fr', $pages['fr'])}}</p>
		    </div>
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