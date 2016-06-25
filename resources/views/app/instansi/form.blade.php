@extends('layout')

@section('form')

	@include('partials.error')
	<div class="row form-group">
		<div class="col-md-3">
			{!! Form::label('instansi', 'Nama Instansi', ['class' => 'control-label']) !!}
		</div>
		<div class="col-md-9">
			{!! Form::text('instansi', $instansi->dinas, ['class' => 'form-control']) !!}
		</div>
	</div>

	<div class="row form-group">
		<div class="col-md-3">
			{!! Form::label('alamat', null, ['class' => 'control-label']) !!}
		</div>
		<div class="col-md-9">
			{!! Form::text('alamat', $instansi->alamat, ['class' => 'form-control']) !!}
		</div>
	</div>

	<div class="row form-group">
		<div class="col-md-3">
			{!! Form::label('telp', null, ['class' => 'control-label']) !!}
		</div>
		<div class="col-md-9">
			{!! Form::tel('telp', $instansi->telp, ['class' => 'form-control input-mask input-mask-telephone']) !!}
		</div>
	</div>

	<div class="row form-group">
		<div class="col-md-3">
			{!! Form::label('email', null, ['class' => 'control-label']) !!}
		</div>
		<div class="col-md-9">
			{!! Form::email('email', $instansi->email, ['class' => 'form-control']) !!}
		</div>
	</div>
@stop

@section('content')
@include('partials.form')
@stop