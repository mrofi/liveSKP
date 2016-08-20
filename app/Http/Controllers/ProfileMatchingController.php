<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests;
use App\LiveServices\AutoNumbering;
use App\Score as Model;

class ProfileMatchingController extends BaseController
{
    protected $withoutMenu = true;
    protected $judulIndex = 'Profile Matching';

    public function __construct(Model $model, $base = 'profileMatching')
    {
        parent::__construct($model, $base);
        $fields = [
            'nomor' => 'No.',
            'pns' => 'PNS',
            'tugas' => 'Tugas',
            'angka_kredit' => 'Angka Kredit',
            'kuantitas' => 'Nilai Kuantitas',
            'kualitas' => 'Nilai Kualitas',
            'waktu' => 'Nilai Waktu',
            'biaya' => 'Nilai Biaya',
            'total_nilai' => 'Total Nilai',
            'nilai' => 'Nilai',
            'keterangan' => 'Keterangan',
        ];

        view()->share('fields', $fields);
        view()->share('unsortables', array_keys($fields));
        view()->share('breadcrumb2', 'Profile Matching');
        view()->share('breadcrumb2Icon', 'search-plus');
        view()->share('noAddButton', true);
        view()->share('withoutMenu', true);
        view()->share('withoutSearch', true);
    }

    public function getIndex()
    {
        parent::getIndex();
        
        if (!session()->has('input')) {
            
            view()->share('action', 'postSearch');
            view()->share('withoutSubmit', true);
            view()->share(compact('dataUrl'));

            return view('app.profileMatching.form');
        }

        $dataUrl = action('ProfileMatchingController@anyData', request()->all());
        view()->share(compact('dataUrl'));
        return view('app.profileMatching.index');
    }

    public function postSearch(Request $request)
    {
        $input = collect($request->except('_token'))->filter(function ($item) {
            return !empty($item);
        });
        session()->put('input', $input);
        return redirect('profileMatching');
    }

    public function anyData($id = null)
    {
        $datas = $this->model;
        $dependencies = $datas->dependencies();
        if ($id) {
            $model = $datas->with($dependencies)->findOrFail($id);
            $id = $model->targetKerja->pluck('id')->toArray();
        }

        // if (session()->has('input')) {

        // }
        return parent::anyData($id);
    }

    protected function processDatatables($datatables)
    {
        return $datatables
            ->addColumn('nomor', function($data) {
                return AutoNumbering::getNumber();
            })
            ->addColumn('pns', function($data) {
                $pns = $data->targetKerja->skp->pns;
                return $pns->nama. ' - '.$pns->nip;
            })
            ->addColumn('tugas', function($data) {
                return $data->targetKerja->tugas;
            })
            ->addColumn('angka_kredit', function($data) {
                return $data->targetKerja->angka_kredit;
            })
            ->addColumn('total_nilai', function($data) {
                return $data->total_nilai;
            })
            ->addColumn('keterangan', function($data) {
                return $data->getKeterangan($data->targetKerja->nilai);
            })
            ->editColumn('nilai', function($data) {
                return $data->targetKerja->nilai;
            });
    }
}
