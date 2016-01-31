<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests;
use App\User as Model;

class ProfileController extends BaseController
{
 
    public function __construct(Model $model, $base = 'profile')
    {
        parent::__construct($model, $base);
        view()->share('breadcrumb2Icon', 'image');
        view()->share('noAddButton', true);
    }
}
