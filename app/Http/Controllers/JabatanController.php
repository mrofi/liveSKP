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
            ->editColumn('struktural', function($data) {
                return ($data->struktural) ? '<span class="label label-success"><i class="fa fa-check"></i></span>' : '<span class="label label-default"><i class="fa fa-times"></i></span>';
            });
    }
}
