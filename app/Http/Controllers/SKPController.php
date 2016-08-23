<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Carbon\Carbon;
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
        $pns_id = $this->pns->id;
        $penilai_id = $this->pns->atasan_id;
        $this->skp = $this->pns->skps->last() ?: SKP::create(compact('pns_id', 'penilai_id'));
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
        $fields = array_except($fields, ['id', 'skp_id', 'satuan_kuantitas', 'satuan_kualitas', 'satuan_waktu', 'satuan_biaya', 'nilai']);
        $fields = ['nomor' => 'Nomor'] + $fields + ['penilaian_kuantitas' => 'Penilaian Kuantitas', 'penilaian_kualitas' => 'Penilaian Kualitas', 'penilaian_waktu' => 'Penilaian Waktu', 'penilaian_biaya' => 'Penilaian Biaya ', 'nilai' => 'Nilai', 'keterangan' => 'Keterangan'];
        view()->share('fields', $fields);
        view()->share('unsortables', array_keys($fields));
        view()->share('withoutSearch', true);
            $pns = $this->pns;
        $penilai = $pns->atasan;
        $dataUrl = $this->dataUrl ? $this->dataUrl : action('SKPController@anyData', ['id' => $this->skp ? $this->skp->id : 0]);
        return view('app.skp.index', compact('pns', 'penilai', 'dataUrl'));
    }

    public function anyData($id = null)
    {
        if ($id) {
            $model = SKP::with('targetKerja')->findOrFail($id);
            $id = $model->targetKerja->pluck('id')->toArray();
        }
            
        return parent::anyData($id);
    }

    public function getShow($skp_id)
    {
        $skp = SKP::with('targetKerja.penilaian')->findOrFail($skp_id);
        $user = auth()->user();
        if ((!$user->is_admin && !$user->pns) || ($skp->pns && $user->pns && $skp->pns->atasan->id != $user->pns->id)) return abort('404');
        $this->pns = $skp->pns;
        $this->dataUrl = action('SKPController@anyData', ['id' => $skp_id]);
        $this->judulIndex = 'Penilaian SKP - '.$skp->pns->id;
        $this->deskripsiIndex = ' ';
        $this->breadcrumb3Index = $skp->pns->nama;
        $doneButton = $user->pns && $skp->targetKerja->filter(function ($item) {
            return !$item->penilaian;
        })->count() == 0;
        if ($user->is_admin) {
            view()->share('withoutMenu', true);
        }
        view()->share('doneButton', $doneButton);
        view()->share('doneButtonUrl', action('SKPController@getDone', compact('skp_id')));
        view()->share('breadcrumb2', 'Penilaian SKP');
        view()->share('breadcrumb2Url', '/penilaian');
        view()->share('noAddButton', true);
        return $this->getIndex();
    }

    public function getDone($skp_id)
    {
        $skp = SKP::with('targetKerja.penilaian')->findOrFail($skp_id);
        if (!$skp->pns->atasan || $skp->pns->atasan->id != auth()->user()->pns->id) return abort('404');
        $done = auth()->user()->pns && $skp->targetKerja->filter(function ($item) {
            return !$item->penilaian;
        })->count() == 0;
        if (!$done) return back();

        $nilai = $skp->targetKerja->average('nilai');
        $tanggal_penilaian = Carbon::now();
        $skp->update(compact('nilai', 'tanggal_penilaian'));
        return redirect('penilaian');
    }

    protected function processRequest($request)
    {
        $skp_id = $this->skp->id;
        $request->merge(compact('skp_id'));
        return $request;
    }

    protected function processDatatables($datatables)
    {
        $id = auth()->user()->pns ? auth()->user()->pns->id : null;
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
            ->addColumn('nilai', function($data) {
                return $data->nilai ?: '-';
            })
            ->addColumn('keterangan', function($data) {
                return $data->getKeterangan($data->nilai);
            })
            ->editColumn('menu', function ($data) use ($id) {
                if (!$id) {
                    return '-';
                }

                if ($data->skp->pns->id == $id) {
                    return
                    '<a href="'.action($this->baseClass.'@getEdit', [$data->{$this->model->getKeyName()}]).'" class="btn btn-small btn-link"><i class="fa fa-xs fa-pencil"></i> Edit</a> '.
                    Form::open(['style' => 'display: inline!important', 'method' => 'delete', 'action' => [$this->baseClass.'@deleteHapus', $data->{$this->model->getKeyName()}]]).'  <button type="submit" onClick="return confirm(\'Yakin mau menghapus?\');" class="btn btn-small btn-link"><i class="fa fa-xs fa-trash-o"></i> Delete</button></form>';
                }
                
                return '<a href="/penilaian/'.$data->id.'   " class="btn btn-small btn-link"><i class="fa fa-xs fa-check"></i> Beri Nilai</a>';
            });
    }


}
