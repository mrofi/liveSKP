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
			{!! Form::label('status', 'Status', ['class' => 'control-label']) !!}
		</div>
		<div class="col-md-9">
			<label for="struktural" class="control-label">
				{!! Form::radio('status', App\Jabatan::STRUKTURAL, $jabatan->status == App\Jabatan::STRUKTURAL, ['id' => 'struktural']) !!} Struktural
			</label>
			&nbsp;
			<label for="fungsional" class="control-label">
				{!! Form::radio('status', App\Jabatan::FUNGSIONAL, $jabatan->status == App\Jabatan::FUNGSIONAL, ['id' => 'fungsional']) !!} Fungsional
			</label>
		</div>
	</div>
@stop

@section('content')
@include('partials.form')
@stop