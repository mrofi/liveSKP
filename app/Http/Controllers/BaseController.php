<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests;

use Illuminate\Database\Eloquent\Model as Model;

class BaseController extends Controller
{
	protected $model;
	protected $base;

    public function __construct(Model $model, $base = '')
    {
    	$this->model = $model;
    	$this->base = $base;

    	view()->share('fields', array_map('ucwords', $this->model->getFillable()));	
    	view()->share('base', $this->base);	
    	view()->share('breadcrumbLevel', 3);	
    }
}
