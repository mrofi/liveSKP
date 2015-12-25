@extends('layout')

@section('judul', 'Dinas')
@section('deskripsi', 'Daftar Dinas')

@section('breadcrumb2', 'Dinas')
@section('breadcrumb2.url', action('DinasController@getIndex'))
@section('breadcrumb3', 'Semua')


@section('content')

<h4>
	
<a href="{{ action('DinasController@getTambah') }}" class="btn btn-sm btn-success">Tambah</a> <small>Klik untuk menambah data dinas.</small>
</h4>
<div class="box">
  	<div class="box-body">
		<table class="table datatables">
			<thead>
				<th>ID</th>
				@foreach($fields as $field)
				<th>{{ $field }}</th>
				@endforeach
				<th>Menu</th>
			</thead>
		</table>  	  	
  	</div><!-- /.box-body -->
</div><!-- /.box-->

@stop

