<?php

namespace App\Http\Controllers;

use Form;
use Upload;
use Illuminate\Http\Request;
use App\Http\Requests;
use App\User as Model;

class ProfileController extends BaseController
{
    protected $withoutMenu = true;
 
    public function __construct(Model $model, $base = 'profile')
    {
        parent::__construct($model, $base);
        view()->share('breadcrumb2Icon', 'image');
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

    public function me()
    {
        $view = [
            'title' => 'Profile Saya',
            'deskripsi' => 'Untuk merubah profile dan password.',
            'action' => 'meUpdate',
        ];
        view()->share($view);

        $profile = auth()->user();
        return view('app.profile.form', compact('profile'));
    }

    public function meUpdate(Request $request)
    {
        $profile = auth()->user();
        $profile->fill($request->all());
        Upload::model($profile);
        $profile->save();

        return redirect()->action('ProfileController@me');
    }
}
