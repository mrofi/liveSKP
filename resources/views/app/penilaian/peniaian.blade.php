@extends('layout')

@section('content')
<div class="row">
    <div class="col-md-6">
        PNS
    </div>
    <div class="col-md-6">
        PENILAI
    </div>
</div>
<h4>
	<a href="{{ action($baseClass.'@getTambah') }}" class="btn btn-sm btn-success">Tambah</a> <small>Klik untuk menambah data tugas kerja.</small>
</h4>
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
    				<th rowspan="2">Menu</th>
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