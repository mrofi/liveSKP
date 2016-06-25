<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests;
use App\Jabatan as Model;

class JabatanController extends BaseController
{
    public function __construct(Model $model, $base = 'jabatan')
    {
        parent::__construct($model, $base);
        view()->share('breadcrumb2Icon', 'tag');
        view()->share('fields', ['id' => 'ID', 'jabatan' => 'Jabatan', 'status' => 'Status']);
        view()->share('unsortables', ['status']);
    }

    public function processRequest($request)
    {
        if (!$request->has('struktural')) {
            $request->merge(['struktural' => 0]);
        }

        return $request;
    }

    protected function processDatatables($datatables)
    {
        return $datatables
            ->editColumn('status', function ($data) {
                return ($data->status == Model::STRUKTURAL) ? '<span class="label label-success"><i class="fa fa-check"></i></span> '.Model::STRUKTURAL : '<span class="label label-default"><i class="fa fa-times"></i></span> '.Model::FUNGSIONAL;
            });
    }
}
