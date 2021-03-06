@extends('layout')

@section('content')
<div class="row">
    <div class="col-sm-5">
            <div class="row">
                <label class="col-sm-2 control-label"><h4>PNS</h4></label>
            </div>
            <div class="row">
                <label class="col-sm-2 control-label">Nama</label>
                <div class="col-sm-9">
                    <p class="form-control-static">{{ $pns->nama }}</p>
                </div>
            </div>
            <div class="row">
                <label class="col-sm-2 control-label">NIP</label>
                <div class="col-sm-9">
                    <p class="form-control-static">{{ $pns->nip }}</p>
                </div>
            </div>
            <div class="row">
                <label class="col-sm-2 control-label">Jabatan</label>
                <div class="col-sm-9">
                    <p class="form-control-static">{{ $pns->jabatan ? $pns->jabatan->jabatan : '' }}</p>
                </div>
            </div>
            <div class="row">
                <label class="col-sm-2 control-label">Instansi</label>
                <div class="col-sm-9">
                    <p class="form-control-static">{{ $pns->instansi ? $pns->instansi->instansi : '' }}</p>
                </div>
            </div>
    </div>
    <div class="col-sm-5">
            <div class="row">
                <label class="col-sm-2 control-label"><h4>Penilai</h4></label>
            </div>
        @if(!$penilai) - @else
            <div class="row">
                <label class="col-sm-2 control-label">Nama</label>
                <div class="col-sm-9">
                    <p class="form-control-static">{{ $penilai->nama }}</p>
                </div>
            </div>
            <div class="row">
                <label class="col-sm-2 control-label">NIP</label>
                <div class="col-sm-9">
                    <p class="form-control-static">{{ $penilai->nip }}</p>
                </div>
            </div>
            <div class="row">
                <label class="col-sm-2 control-label">Jabatan</label>
                <div class="col-sm-9">
                    <p class="form-control-static">{{ $penilai->jabatan ? $penilai->jabatan->jabatan : '' }}</p>
                </div>
            </div>
            <div class="row">
                <label class="col-sm-2 control-label">Instansi</label>
                <div class="col-sm-9">
                    <p class="form-control-static">{{ $penilai->instansi ? $penilai->instansi->instansi : '' }}</p>
                </div>
            </div>
        @endif
    </div>
    <div class="col-sm-2 hidden-print" style="padding-top: 3em; padding-bottom: 3em;">
        @if (isset($doneButton) && $doneButton)
            <a href="{{$doneButtonUrl}}" class="btn btn-success btn-lg btn-block"><i class="fa fa-check"></i> Selesai Beri Nilai</a>
        @endif
        <button class="btn btn-success btn-lg btn-block" onclick="javascript:window.print();"><i class="fa fa-print"></i> Cetak</button>
    </div>
</div>
<div class="row">
    <div class="col-sm-12">
        <hr>
    </div>
</div>
<?php 
    $noAddButton = isset($noAddButton) ? $noAddButton : false;

?>
@if(!$noAddButton) 
<h4 class="hidden-print">
	<a href="{{ action($baseClass.'@getTambah') }}" class="btn btn-sm btn-success">Tambah</a> <small>Klik untuk menambah data tugas kerja.</small>
</h4>
@endif
<div class="box">
  	<div class="box-body">
		<table class="table datatables">
			<thead>
                <tr>
                    <th rowspan="2">No.</th>
                    <th rowspan="2">Tugas Kerja</th>
                    <th rowspan="2">Angka Kredit</th>
                    <th colspan="4" class="text-center">Target</th>
                    <th colspan="4" class="text-center">Realisasi</th>
                    <th rowspan="2" class="text-center">Nilai</th>
                    <th rowspan="2" class="text-center">Keterangan</th>
                    @if (!isset($withoutMenu))
    				<th rowspan="2" class="text-center">Menu</th>
                    @endif
                </tr>
                <tr>
                    <th>Kuantitas</th>
                    <th>Kualitas</th>
                    <th>Waktu</th>
                    <th>Biaya</th>
                    <th>Kuantitas</th>
                    <th>Kualitas</th>
                    <th>Waktu</th>
                    <th>Biaya</th>
                </tr>
			</thead>
		</table>  	  	
  	</div><!-- /.box-body -->
</div><!-- /.box-->
@stop