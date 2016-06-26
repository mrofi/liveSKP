@extends('layout')

@section('form')

	@include('partials.error')

	<div class="row form-group">
		<div class="col-md-3">
			{!! Form::label('name', 'Nama', ['class' => 'control-label']) !!}
		</div>
		<div class="col-md-9">
            {!! Form::text('name', $profile->name, ['class' => 'form-control']) !!}
        </div>
    </div>

    <div class="row form-group">
        <div class="col-md-3">
            {!! Form::label('email', 'Email', ['class' => 'control-label']) !!}
        </div>
        <div class="col-md-9">
            {!! Form::email('email', $profile->email, ['class' => 'form-control', 'rows' => '3']) !!}
		</div>
	</div>

    <div class="row form-group">
        <div class="col-md-3">
            {!! Form::label('deskripsi', 'Deskripsi', ['class' => 'control-label']) !!}
        </div>
        <div class="col-md-9">
            {!! Form::textarea('deskripsi', $profile->deskripsi, ['class' => 'form-control']) !!}
        </div>
    </div>
	
	<div class="row form-group">
        <div class="col-md-3">
			{!! Form::label('foto', 'Foto', ['class' => 'control-label']) !!}
        </div>
        <div class="col-md-9">
            @if ($picture = $profile->foto_thumbnail)
            <div class="row">
                <div class="col-sm-4 col-md-3">
                    <figure style="width: 100%;">
                        <img src="{{ $picture }}" class="img-responsive" alt="">
                    </figure>
                    <div class="row">&nbsp;</div>
                </div>
            </div>
            @endif
            <div class="row">
                <div class="col-sm-12">
                @if ($picture = $profile->foto_thumbnail)
                    <strong>Ganti Foto</strong>
                @endif
                    {!! Form::file('foto', null, ['class' => 'form-control']) !!}
                </div>
            </div>
        </div>
    </div>

@stop

@section('content')
@include('partials.form', ['formFiles' => true])
@stop