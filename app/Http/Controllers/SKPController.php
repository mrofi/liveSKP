<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\SKP;
use App\PNS;
use App\TargetKerja as Model;
use App\Http\Requests;

class SKPController extends BaseController
{

    protected $targetKerja;
    protected $skp;

    public function __construct(Model $model, $base = 'skp')
    {
        parent::__construct($model, $base);
        $this->judulIndex = 'SKP Saya';
        $this->deskripsiIndex = 'SKP Saya';
        $this->breadcrumb3Index = 'Lihat';
        $this->judulTambah = 'Tambah Target Kerja';
        $this->deskripsiTambah = 'Form untuk Tambah Target Kerja';
        $this->breadcrumb3Tambah = 'Tambah Target Kerja';
        $this->judulEdit = 'Edit Target Kerja';
        $this->deskripsiEdit = 'Form untuk Edit Target Kerja';
        $this->breadcrumb3Edit = 'Edit Target Kerja';
        view()->share('breadcrumb2', 'SKP Saya');
        view()->share('breadcrumb2Icon', 'file-o');    
    }

    public function getIndex()
    {
        parent::getIndex();
        view()->share('breadcrumb3', 'Lihat');
        $fields = $this->model->getFillable();
        $fields = array_flip(array_except(array_flip($fields), ['satuan_kuantitas', 'satuan_kualitas', 'satuan_waktu', 'satuan_biaya']));

        view()->share('fields', $fields);
        return view('app.skp.index');
    }

    protected function processRequest($request)
    {
        $skp_id = $this->skp->id;
        $request->merge(compact('skp_id'));
        return $request;
    }

    public function postTambah(Request $request)
    {
        $pns = PNS::first();
        $pns_nip = $pns->nip;
        $penilai_nip = $pns->atasan_nip;
        $this->skp = SKP::create(compact('pns_nip', 'penilai_nip'));

        return parent::postTambah($request);
    }

    public function postEdit(Request $request, $id)
    {
        $model = $this->model->find($id);
        $this->skp = $model->skp;
        return parent::postEdit($request, $id);
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


}
