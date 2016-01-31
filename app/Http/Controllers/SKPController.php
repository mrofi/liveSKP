<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Form;
use App\SKP;
use App\PNS;
use App\TargetKerja as Model;
use App\Http\Requests;
use App\LiveServices\AutoNumbering;

class SKPController extends BaseController
{

    protected $targetKerja;
    protected $skp;
    protected $pns;
    protected $dataUrl;
    protected $unsortables = ['nomor', 'penilaian_kuantitas', 'penilaian_kualitas', 'penilaian_waktu', 'penilaian_biaya'];

    protected $judulIndex = 'SKP Saya';
    protected $deskripsiIndex = 'SKP Saya';
    protected $breadcrumb3Index = 'Lihat';
    protected $judulTambah = 'Tambah Target Kerja';
    protected $deskripsiTambah = 'Form untuk Tambah Target Kerja';
    protected $breadcrumb3Tambah = 'Tambah Target Kerja';
    protected $judulEdit = 'Edit Target Kerja';
    protected $deskripsiEdit = 'Form untuk Edit Target Kerja';
    protected $breadcrumb3Edit = 'Edit Target Kerja';
    
    public function __construct(Model $model, $base = 'skp')
    {
        parent::__construct($model, $base);
        $this->pns = auth()->user()->pns;
        if ($this->pns == null) {
            return back();
        }
        $this->skp = $this->pns->skps->last();
        view()->share('breadcrumb2', 'SKP Saya');
        view()->share('breadcrumb2Icon', 'file-o');  
    }

    public function getIndex()
    {
        if ($this->pns == null) {
            return back();
        }
        parent::getIndex();
        $fields = $this->model->getFields();
        $fields = array_except($fields, ['id', 'skp_id', 'satuan_kuantitas', 'satuan_kualitas', 'satuan_waktu', 'satuan_biaya']);
        $fields = ['nomor' => 'Nomor'] + $fields + ['penilaian_kuantitas' => 'Penilaian Kuantitas', 'penilaian_kualitas' => 'Penilaian Kualitas', 'penilaian_waktu' => 'Penilaian Waktu', 'penilaian_biaya' => 'Penilaian Biaya '];
        view()->share('fields', $fields);
        $pns = $this->pns;
        $penilai = $pns->atasan;
        $dataUrl = $this->dataUrl ? $this->dataUrl : action('SKPController@anyData', ['id' => $this->skp ? $this->skp->id : 0]);
        return view('app.skp.index', compact('pns', 'penilai', 'dataUrl'));
    }

    public function getShow($skp_id)
    {
        $skp = SKP::findOrFail($skp_id);
        if (!$skp->pns->atasan || $skp->pns->atasan->nip != auth()->user()->pns->nip) return abort('404');
        $this->pns = $skp->pns;
        $this->dataUrl = action('SKPController@anyData', ['id' => $skp_id]);
        $this->judulIndex = 'Penilaian SKP - '.$skp->pns->nip;
        $this->deskripsiIndex = ' ';
        $this->breadcrumb3Index = $skp->pns->nip;
        view()->share('breadcrumb2', 'Penilaian SKP');
        view()->share('breadcrumb2Url', '/penilaian');
        view()->share('noAddButton', true);
        return $this->getIndex();
    }

    protected function processRequest($request)
    {
        $skp_id = $this->skp->id;
        $request->merge(compact('skp_id'));
        return $request;
    }

    public function postTambah(Request $request)
    {
        $pns_nip = $this->pns->nip;
        $penilai_nip = $this->pns->atasan_nip;
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
        $nip = auth()->user()->pns->nip;
        return $datatables
            ->editColumn('kuantitas', function($data) {
                return $data->kuantitas.' '.$data->satuan_kuantitas;
            })
            ->editColumn('kualitas', function($data) {
                return $data->kualitas.' '.$data->satuan_kualitas;
            })
            ->editColumn('waktu', function($data) {
                return $data->waktu.' '.$data->satuan_waktu;
            })
            ->editColumn('biaya', function($data) {
                return $data->biaya.' '.$data->satuan_biaya;
            })
            ->addColumn('penilaian_kuantitas', function($data) {
                if ($data->penilaian) 
                {
                    return $data->penilaian->kuantitas.' '.$data->satuan_kuantitas;
                }
                return '-';
            })
            ->addColumn('penilaian_kualitas', function($data) {
                if ($data->penilaian) 
                {
                    return $data->penilaian->kualitas.' '.$data->satuan_kualitas;
                }
                return '-';
            })
            ->addColumn('penilaian_waktu', function($data) {
                if ($data->penilaian) 
                {
                    return $data->penilaian->waktu.' '.$data->satuan_waktu;
                }
                return '-';
            })
            ->addColumn('penilaian_biaya', function($data) {
                if ($data->penilaian) 
                {
                    return $data->penilaian->biaya.' '.$data->satuan_biaya;
                }
                return '-';
            })
            ->addColumn('nomor', function($data) {
                return AutoNumbering::getNumber();
            })
            ->editColumn('menu', function ($data) use ($nip) {
                if ($data->skp->pns->nip == $nip) {
                    return
                    '<a href="'.action($this->baseClass.'@getEdit', [$data->{$this->model->getKeyName()}]).'" class="btn btn-small btn-link"><i class="fa fa-xs fa-pencil"></i> Edit</a> '.
                    Form::open(['style' => 'display: inline!important', 'method' => 'delete', 'action' => [$this->baseClass.'@deleteHapus', $data->{$this->model->getKeyName()}]]).'  <button type="submit" onClick="return confirm(\'Yakin mau menghapus?\');" class="btn btn-small btn-link"><i class="fa fa-xs fa-trash-o"></i> Delete</button></form>';
                }
                
                return '<a href="/penilaian/'.$data->id.'   " class="btn btn-small btn-link"><i class="fa fa-xs fa-check"></i> Beri Nilai</a>';
            });
    }


}
