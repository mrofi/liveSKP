@extends('layout')

@section('form')

    @include('partials.error')
    <div class="row form-group">
        <div class="col-md-3">
            {!! Form::label('tugas', 'Tugas', ['class' => 'control-label']) !!}
        </div>
        <div class="col-md-9">
            <p class="form-static-control">{{ $penilaian->tugas }}</p>
        </div>
    </div>

    <div class="row form-group">
        <div class="col-md-3">
            {!! Form::label('angka_kredit', 'Angka Kredit', ['class' => 'control-label']) !!}
        </div>
        <div class="col-md-3">
            <p class="form-static-control">{{ $penilaian->angka_kredit }}</p>
        </div>
    </div>

    <div class="row form-group">
        <div class="col-md-3">
            {!! Form::label('kuantitas', 'Kuantitas', ['class' => 'control-label']) !!}
        </div>
        <div class="col-md-9 row">
            <div class="col-sm-4">
                {!! Form::text('kuantitas',  !$penilaian->penilaian ? null : $penilaian->penilaian->kuantitas, ['class' => 'form-control']) !!}
            </div>
            <div class="col-sm-8">
                <p class="form-static-control">{{ $penilaian->satuan_kuantitas }}</p>
            </div>
        </div>
    </div>

    <div class="row form-group">
        <div class="col-md-3">
            {!! Form::label('kualitas', 'Kualitas', ['class' => 'control-label']) !!}
        </div>
        <div class="col-md-9 row">
            <div class="col-sm-4">
                {!! Form::text('kualitas', !$penilaian->penilaian ? null : $penilaian->penilaian->kualitas, ['class' => 'form-control']) !!}
            </div>
            <div class="col-sm-8">
                <p class="form-static-control">{{ $penilaian->satuan_kualitas }}</p>
            </div>
        </div>
    </div>

    <div class="row form-group">
        <div class="col-md-3">
            {!! Form::label('waktu', 'Waktu', ['class' => 'control-label']) !!}
        </div>
        <div class="col-md-9 row">
            <div class="col-sm-4">
                {!! Form::text('waktu', !$penilaian->penilaian ? null : $penilaian->penilaian->waktu, ['class' => 'form-control']) !!}
            </div>
            <div class="col-sm-8">
                <p class="form-static-control">{{ $penilaian->satuan_waktu }}</p>
            </div>
        </div>
    </div>
  
    <div class="row form-group">
        <div class="col-md-3">
            {!! Form::label('biaya', 'Biaya', ['class' => 'control-label']) !!}
        </div>
        <div class="col-md-9 row">
            <div class="col-sm-4">
                {!! Form::text('biaya', !$penilaian->penilaian ? null : $penilaian->penilaian->biaya, ['class' => 'form-control']) !!}
            </div>
            <div class="col-sm-8">
                <p class="form-static-control">{{ $penilaian->satuan_biaya }}</p>
            </div>
        </div>
    </div>

@stop

@section('sideContent')
            <div class="row">
                <label class="col-sm-3 control-label"><h4>PNS</h4></label>
            </div>
            <div class="row">
                <label class="col-sm-3 control-label">Nama</label>
                <div class="col-sm-9">
                    <p class="form-control-static">{{ $pns->nama }}</p>
                </div>
            </div>
            <div class="row">
                <label class="col-sm-3 control-label">NIP</label>
                <div class="col-sm-9">
                    <p class="form-control-static">{{ $pns->nip }}</p>
                </div>
            </div>
            <div class="row">
                <label class="col-sm-3 control-label">Jabatan</label>
                <div class="col-sm-9">
                    <p class="form-control-static">{{ $pns->jabatan ? $pns->jabatan->jabatan : '' }}</p>
                </div>
            </div>
            <div class="row">
                <label class="col-sm-3 control-label">Instansi</label>
                <div class="col-sm-9">
                    <p class="form-control-static">{{ $pns->instansi ? $pns->instansi->instansi : '' }}</p>
                </div>
            </div>
@stop

@section('content')
@include('partials.form')
@stop