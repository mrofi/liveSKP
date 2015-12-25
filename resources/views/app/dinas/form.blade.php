@extends('layout')

@section('form')

	@include('partials.error')
	<div class="row form-group">
		<div class="col-md-3">
			{!! Form::label('dinas', 'Nama Dinas', ['class' => 'control-label']) !!}
		</div>
		<div class="col-md-9">
			{!! Form::text('dinas', $dinas->dinas, ['class' => 'form-control']) !!}
		</div>
	</div>

	<div class="row form-group">
		<div class="col-md-3">
			{!! Form::label('alamat', null, ['class' => 'control-label']) !!}
		</div>
		<div class="col-md-9">
			{!! Form::text('alamat', $dinas->alamat, ['class' => 'form-control']) !!}
		</div>
	</div>

	<div class="row form-group">
		<div class="col-md-3">
			{!! Form::label('telp', null, ['class' => 'control-label']) !!}
		</div>
		<div class="col-md-9">
			{!! Form::tel('telp', $dinas->telp, ['class' => 'form-control']) !!}
		</div>
	</div>

	<div class="row form-group">
		<div class="col-md-3">
			{!! Form::label('email', null, ['class' => 'control-label']) !!}
		</div>
		<div class="col-md-9">
			{!! Form::email('email', $dinas->email, ['class' => 'form-control']) !!}
		</div>
	</div>
@stop

@section('content')
@include('partials.form')
@stop