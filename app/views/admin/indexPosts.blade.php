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
		<div class="admin-navigation clearfix">
			<div class="grid_1 alpha">
				&nbsp;
			</div>
			<div class="grid_7">&nbsp;</div>
			<div class="grid_3 omega" style="text-align:right">
				<a href="{{url('admin/noticias/criar')}}" class="btn btn-save" style="color:white">Criar nova página</a>
			</div>
		</div>
		<table>
			<tbody>
				<tr>
					<td><strong>Notícia</strong></td>
					<td><strong>Última modificação</strong></td>
					<td><strong></strong></td>
				</tr>
				
				@foreach($content as $post)
    			<tr>
    				<td><a href='{{url("admin/noticias/{$post['slug']}/editar")}}'>{{$post['name']}}</a></td>
    				<td>{{(new DateTime())->setTimestamp($post['last_modified'])->format('d\/m\/Y H:i:s')}}</td>
    				<td><a href='{{url("admin/noticias/{$post['slug']}/excluir")}}'>excluir</a></td>
    			</tr>
				@endforeach
			</tbody>
		</table>
    </div>
@stop