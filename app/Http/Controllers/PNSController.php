<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests;
use App\Jabatan;
use App\Dinas;
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
        $dinases = Dinas::lists('dinas', 'id')->toArray();
		$atasans = Model::whereHas('Jabatan', function ($query) {
            $query->where('struktural', 1);
        });

        $this->atasans = $atasans;

        $jenis_kelamins = Model::getJenisKelamin();
		
    	view()->share('breadcrumb2', 'PNS');
    	view()->share('breadcrumb2Icon', 'male');
    	view()->share('jabatans', $jabatans);
    	view()->share('dinases', $dinases);
    	view()->share('jenis_kelamins', $jenis_kelamins);
	}

	protected function processDatatables($datatables)
    {
        return $datatables
            ->editColumn('tmt', function($data) {
                return $data->tmt->format('d-F-Y');
            })
	    	->editColumn('jabatan_id', function($data) {
	    		if ($data->jabatan !== null) return $data->jabatan->jabatan;
	    		return '-';
	    	})
	    	->editColumn('dinas_id', function($data) {
	    		if ($data->dinas !== null) return $data->dinas->dinas;
	    		return '-';
	    	})
            ->editColumn('jenis_kelamin', function($data) {
                $jenisKelamins = $this->model->getJenisKelamin();
                return $jenisKelamins[$data->jenis_kelamin];;
            })
	    	->removeColumn('jabatan')
	    	->removeColumn('dinas');
    }

    protected function processRequest($request)
    {
    	if (strlen($nip = $request->get('nip', '')) < 18) $request->merge(['nip' => $nip. str_repeat('_', 18 - strlen($nip))]);
    	
        $atasan = $request->get('atasan', null);
        $newRequests = [
            'jabatan_id' => $request->get('jabatan'),
            'dinas_id' => $request->get('dinas'),
            'atasan_nip' => empty($atasan) ? null : $atasan,
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
     */
    public function getTambah()
    {
        $list = $this->atasans->lists('nama', 'nip')->toArray();

        $atasans = [];
        foreach ($list as $nip => $nama) {
            $atasans[$nip] = "{$nip} - {$nama}"; 
        }

        view()->share('atasans', $atasans);
        return parent::getTambah();
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function getEdit($id)
    {
        $model = $this->model->where($this->model->getKeyName(), $id)->first();

        $atasans = $this->atasans;

        if ($model->dinas_id) $atasans = $atasans->where('dinas_id', $model->dinas_id);

        $list = $atasans->lists('nama', 'nip')->toArray();

        $atasans = [];
        foreach ($list as $nip => $nama) {
            $atasans[$nip] = "{$nip} - {$nama}"; 
        }

        view()->share('atasans', $atasans);

        return parent::getEdit($id);
    }

}
