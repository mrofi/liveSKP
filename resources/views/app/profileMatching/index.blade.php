@extends('layout')

<?php 
    $noAddButton = isset($noAddButton) ? $noAddButton : false;

?>

@section('content')

<div class="box">
    <div class="box-body">
        <h4>Hasil Pencarian Profile</h4>
        <table class="table">
            <tr>
                <th>Kuantitas</th>
                <th>Kualitas</th>
                <th>Waktu</th>
                <th>Biaya</th>
            </tr>
            <tr>
                <td>{{$params['kuantitas'] or ''}}</td>
                <td>{{$params['kuantitas'] or ''}}</td>
                <td>{{$params['waktu'] or ''}}</td>
                <td>{{$params['biaya'] or ''}}</td>
            </tr>
        </table>
        <hr>
        <h4>Data Asli</h4>
        <table class="table">
            <tr>
                <th>PNS</th>
                <th>Tugas</th>
                <th>Angka Kredit</th>
                <th>Nilai Kuantitas</th>
                <th>Nilai Kualitas</th>
                <th>Nilai Waktu</th>
                <th>Nilai Biaya</th>
            </tr>
            @foreach ($data as $g)
            <tr>
                <td>{{$g->targetKerja->skp->pns->nama}}</td>
                <td>{{$g->targetKerja->tugas}}</td>
                <td>{{$g->targetKerja->angka_kredit}}</td>
                <td>{{$g->kuantitas}}</td>
                <td>{{$g->kualitas}}</td>
                <td>{{$g->waktu}}</td>
                <td>{{$g->biaya}}</td>
            </tr>
            @endforeach
        </table>
        <hr>
        <h4>GAP</h4>
        <table class="table">
            <tr>
                <th>PNS</th>
                <th>Tugas</th>
                <th>Angka Kredit</th>
                <th>Nilai Kuantitas</th>
                <th>Nilai Kualitas</th>
                <th>Nilai Waktu</th>
                <th>Nilai Biaya</th>
            </tr>
            @foreach ($gap as $g)
            <tr>
                <td>{{$g->targetKerja->skp->pns->nama}}</td>
                <td>{{$g->targetKerja->tugas}}</td>
                <td>{{$g->targetKerja->angka_kredit}}</td>
                <td>{{$g->kuantitas}}</td>
                <td>{{$g->kualitas}}</td>
                <td>{{$g->waktu}}</td>
                <td>{{$g->biaya}}</td>
            </tr>
            @endforeach
        </table>
        <hr>
        <h4>Pembobotan</h4>
        <table class="table">
            <tr>
                <th>PNS</th>
                <th>Tugas</th>
                <th>Angka Kredit</th>
                <th>Nilai Kuantitas</th>
                <th>Nilai Kualitas</th>
                <th>Nilai Waktu</th>
                <th>Nilai Biaya</th>
                <th>Jumlah</th>
                <th>Rata-rata</th>
            </tr>
            @foreach ($pembobotan as $g)
            <tr>
                <td>{{$g->targetKerja->skp->pns->nama}}</td>
                <td>{{$g->targetKerja->tugas}}</td>
                <td>{{$g->targetKerja->angka_kredit}}</td>
                <td>{{$g->kuantitas}}</td>
                <td>{{$g->kualitas}}</td>
                <td>{{$g->waktu}}</td>
                <td>{{$g->biaya}}</td>
                <td>{{$g->sum}}</td>
                <td>{{$g->average}}</td>
            </tr>
            @endforeach
        </table>
    </div>
</div>
<div class="box">
    <div class="box-body">
        <h4>Hasil</h4>
        <table class="table">
            <tr>
                <th>PNS</th>
                <th>Tugas</th>
                <th>Angka Kredit</th>
                <th>Nilai Kuantitas</th>
                <th>Nilai Kualitas</th>
                <th>Nilai Waktu</th>
                <th>Nilai Biaya</th>
                <th>Jumlah</th>
                <th>Rata-rata</th>
            </tr>
            @foreach ($hasil as $g)
            <tr>
                <td>{{$g->targetKerja->skp->pns->nama}}</td>
                <td>{{$g->targetKerja->tugas}}</td>
                <td>{{$g->targetKerja->angka_kredit}}</td>
                <td>{{$g->kuantitas}}</td>
                <td>{{$g->kualitas}}</td>
                <td>{{$g->waktu}}</td>
                <td>{{$g->biaya}}</td>
                <td>{{$g->sum}}</td>
                <td>{{$g->average}}</td>
            </tr>
            @endforeach
        </table>    
    </div><!-- /.box-body -->
</div><!-- /.box-->
@stop