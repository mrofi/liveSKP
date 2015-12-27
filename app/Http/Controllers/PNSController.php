<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests;
use App\PNS as Model;

class PNSController extends BaseController
{
    protected $judulIndex = 'PNS';
	protected $judulTambah = 'Tambah Data PNS';
	protected $judulEdit = 'Edit Data PNS';
	protected $deskripsiIndex = 'Semua Data PNS';
	protected $deskripsiTambah = 'Untuk menambah data PNS';
	protected $deskripsiEdit = 'Untuk mengedit data PNS';

    public function __construct(Model $model, $base = 'pns')
	{
		parent::__construct($model, $base);
		$jabatans = \App\Jabatan::lists('jabatan', 'id')->toArray();
		$dinases = \App\Dinas::lists('dinas', 'id')->toArray();
		$jenis_kelamins = Model::getJenisKelamin();
		
    	view()->share('breadcrumb2', 'PNS');
    	view()->share('breadcrumb2Icon', 'male');
    	view()->share('jabatans', $jabatans);
    	view()->share('dinases', $dinases);
    	view()->share('jenis_kelamins', $jenis_kelamins);
	}

	public function getIndex()
	{
		parent::getIndex();
    	$newFields = ['jabatan_id' => 'jabatan', 'dinas_id' => 'dinas'];
    	$fields = $this->model->getFillable();
    	foreach ($fields as $key => $value) {
    		if ($value == array_key_exists($value, $newFields)) $fields[$key] = $newFields[$value];
    		$fields[$key] = ucwords(implode(' ', explode('_', $fields[$key])));
    	}
    	view()->share('datatablesFields', $fields);
	

    	return view('partials.appIndex');
	}

	protected function processDatatables($datatables)
    {
        return $datatables
	    	->editColumn('jabatan_id', function($data) {
	    		if ($data->jabatan !== null) return $data->jabatan->jabatan;
	    		return '-';
	    	})
	    	->editColumn('dinas_id', function($data) {
	    		if ($data->dinas !== null) return $data->dinas->dinas;
	    		return '-';
	    	})
	    	->removeColumn('jabatan')
	    	->removeColumn('dinas');
    }

    protected function processRequest($request)
    {
    	if (strlen($nip = $request->get('nip', '')) < 21) $request->merge(['nip' => $nip. str_repeat('_', 21 - strlen($nip))]);
    	$request->merge(['jabatan_id' => $request->get('jabatan')]);
    	$request->merge(['dinas_id' => $request->get('dinas')]);

    	return $request;
    }

}
