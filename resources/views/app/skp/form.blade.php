@extends('layout')

@section('form')

    @include('partials.error')
    <div class="row form-group">
        <div class="col-md-3">
            {!! Form::label('tugas', 'Tugas', ['class' => 'control-label']) !!}
        </div>
        <div class="col-md-9">
            {!! Form::text('tugas', $skp->tugas, ['class' => 'form-control']) !!}
        </div>
    </div>

    <div class="row form-group">
        <div class="col-md-3">
            {!! Form::label('angka_kredit', 'Angka Kredit', ['class' => 'control-label']) !!}
        </div>
        <div class="col-md-3">
            {!! Form::text('angka_kredit', $skp->angka_kredit, ['class' => 'form-control']) !!}
        </div>
    </div>

    <div class="row form-group">
        <div class="col-md-3">
            {!! Form::label('kuantitas', 'Kuantitas', ['class' => 'control-label']) !!}
        </div>
        <div class="col-md-9 row">
            <div class="col-sm-4">
                {!! Form::text('kuantitas', $skp->kuantitas, ['class' => 'form-control']) !!}
            </div>
            <div class="col-sm-8">
                {!! Form::select('satuan_kuantitas', array_merge($satuan_kuantitas, $skp->satuan_kuantitas ? [$skp->satuan_kuantitas => ucwords($skp->satuan_kuantitas)] : []), $skp->satuan_kuantitas, ['class' => 'form-control', 'placeholder' => 'Satuan']) !!}
            </div>
        </div>
    </div>

    <div class="row form-group">
        <div class="col-md-3">
            {!! Form::label('kualitas', 'Kualitas', ['class' => 'control-label']) !!}
        </div>
        <div class="col-md-9 row">
            <div class="col-sm-4">
                {!! Form::text('kualitas', $skp->kualitas, ['class' => 'form-control']) !!}
            </div>
            <div class="col-sm-8">
                {!! Form::input('numeric', 'satuan_kualitas', $skp->satuan_kualitas, ['class' => 'form-control', 'placeholder' => '% (persen)']) !!}
            </div>
        </div>
    </div>

    <div class="row form-group">
        <div class="col-md-3">
            {!! Form::label('waktu', 'Waktu', ['class' => 'control-label']) !!}
        </div>
        <div class="col-md-9 row">
            <div class="col-sm-4">
                {!! Form::text('waktu', $skp->waktu, ['class' => 'form-control']) !!}
            </div>
            <div class="col-sm-8">
                {!! Form::select('satuan_waktu', array_merge($satuan_waktu, $skp->satuan_waktu ? [$skp->satuan_waktu => ucwords($skp->satuan_waktu)] : []), $skp->satuan_waktu, ['class' => 'form-control', 'placeholder' => 'Satuan']) !!}
            </div>
        </div>
    </div>
  
    <div class="row form-group">
        <div class="col-md-3">
            {!! Form::label('biaya', 'Biaya', ['class' => 'control-label']) !!}
        </div>
        <div class="col-md-9 row">
            <div class="col-sm-4">
                {!! Form::text('biaya', $skp->biaya, ['class' => 'form-control']) !!}
            </div>
            <div class="col-sm-8">
                {!! Form::select('satuan_biaya', array_merge($satuan_biaya, $skp->satuan_biaya ? [$skp->satuan_biaya => ucwords($skp->satuan_biaya)] : []), $skp->satuan_biaya, ['class' => 'form-control', 'placeholder' => 'Satuan']) !!}
            </div>
        </div>
    </div>

@stop

@section('content')
@include('partials.form')
@stop