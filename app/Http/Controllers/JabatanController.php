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
}
