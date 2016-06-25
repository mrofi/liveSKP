<?php

namespace App\Http\Controllers;

use Form;
use Illuminate\Http\Request;
use App\Http\Requests;
use App\User as Model;

class SettingController extends BaseController
{
    protected $withoutMenu = true;
 
    public function __construct(Model $model, $base = 'setting')
    {
        parent::__construct($model, $base);
        view()->share('breadcrumb2Icon', 'cog');
        view()->share('noAddButton', true);
        view()->share('withoutMenu', true);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function getEdit($id)
    {
        return redirect($this->base);
    }

    // protected function settingMenu($data)
    // {
    //     return '<a class="btn btn-sm btn-success" href="#"><i class="fa fa-refresh"></i> Reset Password</a>';
    // }
}
