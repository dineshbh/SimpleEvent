@extends('layouts.admin.cms')

@section('content')
	<div class="grid_11">
		<table>
			<tbody>
				<tr>
					<td><strong>Nome da página</strong></td>
					<td><strong>Última modificação</strong></td>
				</tr>
				@foreach($content as $page)
    			<tr>
    				<td><a href='{{url("admin/paginas/{$page['slug']}/editar")}}'>{{$page['name']}}</a></td>
    				<td>{{$page['last_modified']}}</td>
    			</tr>
				@endforeach
			</tbody>
		</table>
    </div>
@stop