<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests;
use App\Instansi as Model;

class InstansiController extends BaseController
{

    public function __construct(Model $model, $base = 'instansi')
    {
        parent::__construct($model, $base);
        view()->share('breadcrumb2Icon', 'dropbox');
    }

    protected function processRequest($request)
    {
        $dinas = $request->get('instansi');
        $request->merge(compact('dinas'));
        return $request;
    }
}
