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
        ];

        view()->share('fields', $fields);
        view()->share('unsortables', array_keys($fields));
        view()->share('breadcrumb2', 'Profile Matching');
        view()->share('breadcrumb2Icon', 'search-plus');
        view()->share('noAddButton', true);
        view()->share('withoutMenu', true);
    }

    public function getIndex()
    {
        $dataUrl = action('ProfileMatchingController@anyData', request()->all());
        view()->share(compact('dataUrl'));

        return parent::getIndex();
    }

    public function anyData($id = null)
    {
        if ($id) {
            $model = SKP::with('targetKerja')->findOrFail($id);
            $id = $model->targetKerja->pluck('id')->toArray();
        }
            
        return parent::anyData($id);
    }

    protected function processDatatables($datatables)
    {
        return $datatables
            ->addColumn('nomor', function($data) {
                return AutoNumbering::getNumber();
            })
            ->addColumn('pns', function($data) {
                $pns = $data->targetKerja->pns;
                return $pns->nama. ' - '.$pns->nip;
            })
            ->addColumn('tugas', function($data) {
                return $data->targetKerja->tugas;
            })
            ->addColumn('angka_kredit', function($data) {
                return $data->targetKerja->angka_kredit;
            })
            ->addColumn('total_nilai', function($data) {
                return $data->targetKerja->angka_kredit;
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
