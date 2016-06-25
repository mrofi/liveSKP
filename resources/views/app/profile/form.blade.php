@extends('layout')

@section('form')

	@include('partials.error')

	<div class="row form-group">
		<div class="col-md-3">
			{!! Form::label('name', 'Nama', ['class' => 'control-label']) !!}
		</div>
		<div class="col-md-9">
			<p class="form-control-static">{{$profile->name}}</p>
		</div>
	</div>

	<div class="row form-group">
		<div class="col-md-3">
			{!! Form::label('email', 'Email', ['class' => 'control-label']) !!}
		</div>
		<div class="col-md-9">
			<p class="form-control-static">{{$profile->email}}</p>
		</div>
	</div>
	
	<div class="row form-group">
        <div class="col-md-3">
			{!! Form::label('foto', 'Foto', ['class' => 'control-label']) !!}
        </div>
        <div class="col-md-9">
            @if ($picture = $profile->foto_url)
            <div class="row">
                <div class="col-sm-4 col-md-3">
                    Preview :
                    <figure style="width: 100%;">
                        <img src="{{ $picture }}" class="img-responsive" alt="">
                    </figure>
                    <div class="row">&nbsp;</div>
                </div>
            </div>
            @endif
            <div class="row">
                <div class="col-sm-12">
                @if ($picture = $profile->foto_url)
                    <strong>Ganti Foto</strong>
                @endif
                    {!! Form::file('foto', null, ['class' => 'form-control']) !!}
                </div>
            </div>
        </div>
    </div>

@stop

@section('content')
@include('partials.form')
@stop