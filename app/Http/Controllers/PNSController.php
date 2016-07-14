<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests;
use App\Jabatan;
use App\Instansi;
use App\PNS as Model;
use Carbon\Carbon;

class PNSController extends BaseController
{
    protected $judulIndex = 'PNS';
    protected $judulTambah = 'Tambah Data PNS';
    protected $judulEdit = 'Edit Data PNS';
    protected $deskripsiIndex = 'Semua Data PNS';
    protected $deskripsiTambah = 'Untuk menambah data PNS';
    protected $deskripsiEdit = 'Untuk mengedit data PNS';

    protected $atasans;

    public function __construct(Model $model, $base = 'pns')
    {
        parent::__construct($model, $base);
        $jabatans = Jabatan::lists('jabatan', 'id')->toArray();
        $instansis = Instansi::lists('instansi', 'id')->toArray();
        $atasans = Model::whereHas('Jabatan', function ($query) {
            $query->where('status', Jabatan::STRUKTURAL);
        });

        $list = $atasans->get();

        $atasans = [];
        foreach ($list as $atasan) {
            $atasans[$atasan->id] = "{$atasan->nip} - {$atasan->nama}";
        }

        $jenis_kelamins = Model::getJenisKelamin();

        view()->share('breadcrumb2', 'PNS');
        view()->share('breadcrumb2Icon', 'male');
        view()->share('jabatans', $jabatans);
        view()->share('instansis', $instansis);
        view()->share('atasans', $atasans);
        view()->share('jenis_kelamins', $jenis_kelamins);
    }

    protected function processDatatables($datatables)
    {
        return $datatables
            ->editColumn('tmt', function ($data) {
                return $data->tmt->format('d-F-Y');
            })
            ->editColumn('jabatan_id', function ($data) {
                if ($data->jabatan !== null) return $data->jabatan->jabatan;
                return '-';
            })
            ->editColumn('instansi_id', function ($data) {
                if ($data->instansi !== null) return $data->instansi->instansi;
                return '-';
            })
            ->editColumn('atasan_id', function ($data) {
                if ($data->atasan !== null) return $data->atasan->nip .' - '. $data->atasan->nama;
                return '-';
            })
            ->editColumn('jenis_kelamin', function ($data) {
                $jenisKelamins = $this->model->getJenisKelamin();
                return $jenisKelamins[$data->jenis_kelamin];
            })
            ->removeColumn('jabatan')
            ->removeColumn('instansi');
    }

    protected function processRequest($request)
    {
        if (strlen($nip = $request->get('nip', '')) < 18) $request->merge(['nip' => $nip. str_repeat('_', 18 - strlen($nip))]);

        $atasan = $request->get('atasan', null);
        $jabatan = $request->get('jabatan', null);
        $instansi = $request->get('instansi', null);
        $newRequests = [
            'jabatan_id' => empty($jabatan) ? null : $jabatan,
            'instansi_id' => empty($instansi) ? null : $instansi,
            'atasan_id' => empty($atasan) ? null : $atasan,
            'originalTmt' => $request->get('tmt'),
            'tmt' => (new Carbon($request->get('tmt')))->format('d-F-Y'),
        ];

        $request->merge($newRequests);

        return $request;
    }

    protected function processRequestAfterValidation($request)
    {
        $newRequests = [
            'tmt' => $request->get('originalTmt'),
        ];

        $request->merge($newRequests);

        return $request;
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
    //  */
    // public function getTambah()
    // {
    //     $list = $this->atasans->get();

    //     $atasans = [];
    //     foreach ($list as $atasan) {
    //         $atasans[$atasan->id] = "{$atasan->nip} - {$atasan->nama}";
    //     }

    //     view()->share('atasans', $atasans);
    //     return parent::getTambah();
    // }

    // /**
    //  * Show the form for editing the specified resource.
    //  *
    //  * @param  int  $id
    //  * @return \Illuminate\Http\Response
    //  */
    // public function getEdit($id)
    // {
    //     $model = $this->model->where($this->model->getKeyName(), $id)->first();

    //     $atasans = $this->atasans;

    //     if ($model->instansi_id) $atasans = $atasans->where('instansi_id', $model->instansi_id);

    //     $list = $atasans->get();

    //     $atasans = [];
    //     foreach ($list as $atasan) {
    //         $atasans[$atasan->id] = "{$atasan->nip} - {$atasan->nama}";
    //     }

    //     view()->share('atasans', $atasans);

    //     return parent::getEdit($id);
    // }
}
