@extends('layout')

@section('form')

    @include('partials.error')
    <div class="row form-group">
        <div class="col-md-12">
            <h4>Pencarian Profile Matching Berdasarkan Persentase Pencapaian Hasil</h4>
        </div>
    </div>

    <div class="row form-group">
        <div class="col-md-3">
            {!! Form::label('kuantitas', 'Kuantitas', ['class' => 'control-label']) !!}
        </div>
        <div class="col-md-9 row">
            <div class="col-xs-8 col-sm-4">
                {!! Form::number('kuantitas',  null, ['class' => 'form-control', 'step' => '1', 'max' => '100', 'required' => true]) !!}
            </div>
            <div class="col-xs-4 col-sm-8">
                <p class="form-static-control">%</p>
            </div>
        </div>
    </div>

    <div class="row form-group">
        <div class="col-md-3">
            {!! Form::label('kualitas', 'Kualitas', ['class' => 'control-label']) !!}
        </div>
        <div class="col-md-9 row">
            <div class="col-xs-8 col-sm-4">
                {!! Form::number('kualitas', null, ['class' => 'form-control', 'step' => '1', 'max' => '100', 'required' => true]) !!}
            </div>
            <div class="col-xs-4 col-sm-8">
                <p class="form-static-control">%</p>
            </div>
        </div>
    </div>

    <div class="row form-group">
        <div class="col-md-3">
            {!! Form::label('waktu', 'Waktu', ['class' => 'control-label']) !!}
        </div>
        <div class="col-md-9 row">
            <div class="col-xs-8 col-sm-4">
                {!! Form::number('waktu', null, ['class' => 'form-control', 'step' => '1', 'max' => '100', 'required' => true]) !!}
            </div>
            <div class="col-xs-4 col-sm-8">
                <p class="form-static-control">%</p>
            </div>
        </div>
    </div>
  
    <div class="row form-group">
        <div class="col-md-3">
            {!! Form::label('biaya', 'Biaya', ['class' => 'control-label']) !!}
        </div>
        <div class="col-md-9 row">
            <div class="col-xs-8 col-sm-4">
                {!! Form::number('biaya', null, ['class' => 'form-control', 'step' => '1', 'max' => '100', 'required' => true]) !!}
            </div>
            <div class="col-xs-4 col-sm-8">
                <p class="form-static-control">%</p>
            </div>
        </div>
    </div>

    <div class="row form-group">
        <div class="col-md-3">&nbsp;</div>
        <div class="col-md-9">
            {!! Form::submit('Cari Profile', ['class' => 'btn btn-primary']) !!}
        </div>
    </div>
@stop

@section('content')
@include('partials.form')
@stop