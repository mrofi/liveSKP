<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use DB;
use Form;
use Datatables;
use App\TargetKerja;
use App\SKP as Model;
use App\Http\Requests;

class PenilaianController extends BaseController
{

    protected $targetKerja;

    public function __construct(Model $model, $base = 'penilaian')
    {
        $this->judulIndex = 'Penilaian SKP';
        $this->deskripsiIndex = 'Daftar Semua SKP';
        parent::__construct($model, $base);
        view()->share('breadcrumb2', 'Penilaian SKP');
        view()->share('breadcrumb2Icon', 'files-o');
    }

    public function semua()
    {
        parent::getIndex();
        view()->share('breadcrumb3', 'Lihat Semua');
        $fields = $this->model->getFields();
        $fields = array_except($fields, ['periode_id', 'penilai_id']);
        $fields = array_merge($fields, ['nilai', 'tanggal_penilaian']);
        view()->share('fields', $fields);
        return view('app.penilaian.index');
    }

    public function data()
    {
        $bawahan = auth()->user()->pns->bawahan;

        $ids = [];

        foreach ($bawahan as $pns) {
            foreach ($pns->skps()->lists('id') as $id) {
                $ids[] = $id;
            }
        }

        $datas = $this->model->select([null => $this->model->getKeyName()]+$this->model->getFillable())->whereIn('id', $ids);

        if ($dependencies = $this->model->dependencies()) {
            $datas = $datas->with($dependencies);
        }

        $datatables = Datatables::of($datas);
        $datatables = $this->processDatatables($datatables);
        $result = $datatables
            ->addColumn('menu', function ($data) {
                return
                '<a href="/penilaian/skp/'.$data->id.'" class="btn btn-small btn-link"><i class="fa fa-xs fa-pencil"></i> Detail</a> ';
            })
            ->make(true);

        return $result;
    }

    public function getEdit($id)
    {
        $model = TargetKerja::with(['penilaian', 'skp'])->where('id', $id)->first();
        if ($model == null) {
            abort('404', 'Data not found');
        }
        // $model = $this->model->findOrFail($id);
        ${$this->base} = $model;
        $pns = $model->skp->pns;

        view()->share('judul', '');
        view()->share('deskripsi', '');
        view()->share('breadcrumb3', 'Beri Nilai');
        view()->share('action', 'postEdit');
        view()->share('params', compact('id'));
        view()->share('formCancelUrl', '/penilaian/skp/'.$model->skp->id);


        return view("app.{$this->base}.form", compact($this->base, 'pns'));
    }

    public function postEdit(Request $request, $id)
    {
        $targetKerja = TargetKerja::with(['penilaian', 'skp'])->where('id', $id)->first();

        $model = $targetKerja->penilaian;

        if ($model == null) {
            $model = $targetKerja->penilaian()->create([]);
        }
        // $model = $this->model->findOrFail($id);
        
        $this->validate($request, $model->rules());
        
        $updated = $model->update($request->all());

        if ($updated) {
            return redirect('skp/'.$targetKerja->skp->id);
        }
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
