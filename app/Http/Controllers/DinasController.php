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
    	view()->share('breadcrumb2Icon', 'dropbox');
	}

}
