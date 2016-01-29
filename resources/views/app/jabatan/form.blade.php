@extends('layout')

@section('form')

	@include('partials.error')
	<div class="row form-group">
		<div class="col-md-3">
			{!! Form::label('jabatan', 'Nama Jabatan', ['class' => 'control-label']) !!}
		</div>
		<div class="col-md-9">
			{!! Form::text('jabatan', $jabatan->jabatan, ['class' => 'form-control']) !!}
		</div>
	</div>

	<div class="row form-group">
		<div class="col-md-3">
			{!! Form::label('struktural', 'Struktural', ['class' => 'control-label']) !!}
		</div>
		<div class="col-md-9">
			{!! Form::checkbox('struktural', 1, $jabatan->struktural) !!}
		</div>
	</div>
@stop

@section('content')
@include('partials.form')
@stop