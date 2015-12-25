<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests;
use App\Dinas as Model;

class DinasController extends BaseController
{

	public function __construct(Model $model, $base = 'dinas')
	{
		parent::__construct($model, $base);
	}

    public function getIndex()
    {
    	return view('app.dinas.index');
    }

    public function getTambah()
    {
    	return view('app.dinas.tambah');
    }

    public function postData($value='')
    {
    	# code...
    }
}
