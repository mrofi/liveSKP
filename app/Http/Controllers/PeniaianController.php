<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\TargetKerja;
use App\SKP as Model;
use App\Http\Requests;

class PenilaianController extends BaseController
{

    protected $targetKerja;

    public function __construct(Model $model, $base = 'penilaian')
    {
        $this->judulIndex = 'Semua SKP';
        $this->deskripsiIndex = 'Daftar Semua SKP';
        parent::__construct($model, $base);
        $this->targetKerja = new TargetKerja();
        view()->share('breadcrumb2', 'Semua SKP');
        view()->share('breadcrumb2Icon', 'files-o');    
    }

    public function getIndex()
    {
        parent::getIndex();
        $newFields = ['periode_id' => 'periode', 'pns_nip' => 'pns', 'penilai_nip' => 'penilai'];
        $delFields = [];
        $fields = $this->model->getFillable();
        foreach ($fields as $key => $value) {
            if ($value == array_key_exists($value, $newFields)) $fields[$key] = $newFields[$value];
            $fields[$key] = ucwords(implode(' ', explode('_', $fields[$key])));
            if (in_array($value, $delFields)) unset($fields[$key]);
        }
        view()->share('datatablesFields', $fields);
    

        return view('partials.appIndex');
    }


    protected function processDatatables($datatables)
    {
        return $datatables
            ->editColumn('periode_id', function($data) {
                if ($data->periode !== null) return $data->periode->awal . ' - ' .$data->periode->awal;
                return '-';
            })
            ->editColumn('pns_id', function($data) {
                if ($data->pns !== null) return $data->pns->nip . ' - '. $data->pns->nama;
                return '-';
            })
            ->editColumn('penilai_id', function($data) {
                if ($data->penilai !== null) return $data->penilai->nip . ' - '. $data->penilai->nama;
                return '-';
            })
            ->removeColumn('periode')
            ->removeColumn('pns')
            ->removeColumn('penilai');
    }


    public function getSaya()
    {
        $this->judulIndex = 'SKP Saya';
        $this->deskripsiIndex = 'SKP Saya';
        parent::getIndex();
        view()->share('breadcrumb2', 'SKP Saya');
        view()->share('breadcrumb2Icon', 'file-o');    
        view()->share('breadcrumb3', 'Lihat');

        return view('app.skp.single');
    }

    public function getTambahTugasKerja()
    {
        $this->judulTambah = 'Tambah Tugas Kerja';
        $this->deskripsiTambah = 'Form untuk menambah tugas kerja';
        $this->breadcrumb3Tambah = 'Tambah Tugas Kerja';
        view()->share('breadcrumb2', 'SKP Saya');
        view()->share('breadcrumb2Icon', 'file-o');    
        return parent::getTambah();
    }

    public function postTugasKerja(Request $request)
    {
        $this->validate($request, $this->targetKerja->rules());

    }

}
