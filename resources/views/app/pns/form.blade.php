@extends('layout')

@section('form')

	@include('partials.error')
	<div class="row form-group">
		<div class="col-md-3">
			{!! Form::label('nip', 'NIP', ['class' => 'control-label']) !!}
		</div>
		<div class="col-md-9">
			{!! Form::text('nip', $pns->nip, ['class' => 'form-control', 'readonly' => (!empty($pns->nip)) ? 'readonly' : null]) !!}
		</div>
	</div>

	<div class="row form-group">
		<div class="col-md-3">
			{!! Form::label('nama', 'Nama PNS', ['class' => 'control-label']) !!}
		</div>
		<div class="col-md-9">
			{!! Form::text('nama', $pns->nama, ['class' => 'form-control']) !!}
		</div>
	</div>

	<div class="row form-group">
		<div class="col-md-3">
			{!! Form::label('alamat', 'Alamat', ['class' => 'control-label']) !!}
		</div>
		<div class="col-md-9">
			{!! Form::text('alamat', $pns->alamat, ['class' => 'form-control']) !!}
		</div>
	</div>

	<div class="row form-group">
		<div class="col-md-3">
			{!! Form::label('jenis_kelamin', 'Jenis Kelamin', ['class' => 'control-label']) !!}
		</div>
		<div class="col-md-9">
			{!! Form::select('jenis_kelamin', [null => 'Pilih Jenis Kelamin'] + $jenis_kelamins, $pns->jenis_kelamin, ['class' => 'form-control']) !!}
		</div>
	</div>

	<div class="row form-group">
		<div class="col-md-3">
			{!! Form::label('telp', 'Telp', ['class' => 'control-label']) !!}
		</div>
		<div class="col-md-9">
			{!! Form::tel('telp', $pns->telp, ['class' => 'form-control']) !!}
		</div>
	</div>

	<div class="row form-group">
		<div class="col-md-3">
			{!! Form::label('email', 'Email', ['class' => 'control-label']) !!}
		</div>
		<div class="col-md-9">
			{!! Form::email('email', $pns->email, ['class' => 'form-control']) !!}
		</div>
	</div>
	
	<div class="row form-group">
		<div class="col-md-3">
			{!! Form::label('tmt', 'TMT', ['class' => 'control-label']) !!}
		</div>
		<div class="col-md-9">
			{!! Form::text('tmt', $pns->tmt, ['class' => 'form-control datepicker', 'onkeydown' => 'return false']) !!}
		</div>
	</div>
	
	<div class="row form-group">
		<div class="col-md-3">
			{!! Form::label('jabatan', 'Jabatan', ['class' => 'control-label']) !!}
		</div>
		<div class="col-md-9">
			{!! Form::select('jabatan', [null => 'Pilih Jabatan'] + $jabatans, $pns->jabatan_id, ['class' => 'form-control']) !!}
		</div>
	</div>

	<div class="row form-group">
		<div class="col-md-3">
			{!! Form::label('dinas', 'Dinas', ['class' => 'control-label']) !!}
		</div>
		<div class="col-md-9">
			{!! Form::select('dinas', [null => 'Pilih Dinas'] + $dinases, $pns->dinas_id, ['class' => 'form-control']) !!}
		</div>
	</div>

	<div class="row form-group">
		<div class="col-md-3">
			{!! Form::label('atasan', 'Atasan', ['class' => 'control-label']) !!}
		</div>
		<div class="col-md-9">
			{!! Form::select('atasan', [null => 'Pilih Atasan'] + $atasans, $pns->atasan_nip, ['class' => 'form-control']) !!}
		</div>
	</div>


@stop

@section('content')
@include('partials.form')
@stop