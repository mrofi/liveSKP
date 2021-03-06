<?php

namespace App\Http\Controllers;

use Form;
use Datatables;
use Illuminate\Http\Request;
use App\Http\Requests;

use Illuminate\Database\Eloquent\Model as Model;

class BaseController extends Controller
{
    protected $model;
    protected $base;
    protected $baseClass;
    protected $fields;
    protected $judulIndex;
    protected $breadcrumb3Index;
    protected $judulTambah;
    protected $judulEdit;
    protected $deskripsiIndex;
    protected $deskripsiTambah;
    protected $deskripsiEdit;
    protected $breadcrumb3Tambah;
    protected $actionTambah;
    protected $unsortables = [];


    public function __construct(Model $model, $base = '')
    {
        $this->model = $model;
        $this->base = $base;
        $this->baseClass = (new \ReflectionClass($this))->getShortName();
        $fields = $this->model->getFields();

        view()->share('unsortables', $this->unsortables);
        view()->share('model', $this->model);
        view()->share('baseClass', $this->baseClass);
        view()->share('fields', $this->fields ? $this->fields : $this->model->getFields());
        view()->share('base', $this->base);
        view()->share('breadcrumbLevel', 3);
        view()->share('breadcrumb1', 'App');
        view()->share('breadcrumb2', ucwords($this->base));
        view()->share('breadcrumb2Url', action($this->baseClass.'@getIndex'));
    }

    protected function processDatatables($datatables)
    {
        return $datatables;
    }

    protected function processRequest($request)
    {
        return $request;
    }

    protected function processRequestAfterValidation($request)
    {
        return $request;
    }

    public function getIndex()
    {
        view()->share('judul', ($this->judulIndex) ? $this->judulIndex : ucwords($this->base));
        view()->share('deskripsi', ($this->deskripsiIndex) ? $this->deskripsiIndex : 'Semua Daftar '.ucwords($this->base));
        view()->share('breadcrumb3', ($this->breadcrumb3Index) ? $this->breadcrumb3Index : 'Lihat Semua');

        return view('partials.appIndex');
    }

    protected function settingMenu($data)
    {
        return
                '<a href="'.action($this->baseClass.'@getEdit', [$data->{$this->model->getKeyName()}]).'" class="btn btn-small btn-link"><i class="fa fa-xs fa-pencil"></i> Edit</a> '.
                Form::open(['style' => 'display: inline!important', 'method' => 'delete', 'action' => [$this->baseClass.'@deleteHapus', $data->{$this->model->getKeyName()}]]).'  <button type="submit" onClick="return confirm(\'Yakin mau menghapus?\');" class="btn btn-small btn-link"><i class="fa fa-xs fa-trash-o"></i> Delete</button></form>';
    }

    public function anyData($id = null)
    {
        $datas = $this->model;

        if ($id !== null) {
            $id = (array) $id;
            $datas = $datas->whereIn($this->model->getKeyName(), $id);
        }

        $datas = $datas->select([null => $this->model->getKeyName()]+$this->model->getFillable());

        if ($dependencies = $this->model->dependencies()) {
            $datas = $datas->with($dependencies);
        }

        $datatables = Datatables::of($datas);
        if (!property_exists($this, 'withoutMenu')) {
            $datatables = $datatables
                ->addColumn('menu', function ($data) {
                    return $this->settingMenu($data);
                });
        }

        $result = $this->processDatatables($datatables)
            ->make(true);

        return $result;
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function getTambah()
    {
        $model = $this->model;
        ${$this->base} = $model;

        view()->share('judul', ($this->judulTambah) ? $this->judulTambah : 'Tambah Data '.ucwords($this->base));
        view()->share('deskripsi', ($this->deskripsiTambah) ? $this->deskripsiTambah : 'Untuk menambahkan data '.$this->base);
        view()->share('breadcrumb3', ($this->breadcrumb3Tambah) ? $this->breadcrumb3Tambah : 'Tambah');
        view()->share('action', ($this->actionTambah) ? $this->actionTambah : 'postTambah');


        return view("app.{$this->base}.form", compact($this->base));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function postTambah(Request $request)
    {
        $request = $this->processRequest($request);

        $this->validate($request, $this->model->rules());

        $request = $this->processRequestAfterValidation($request);

        $created = $this->model->create($request->all());

        if ($created) {
            return redirect($this->base);
        }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function getEdit($id)
    {
        $model = $this->model->where($this->model->getKeyName(), $id)->first();
        if ($model == null) {
            abort('404', 'Data not found');
        }
        // $model = $this->model->findOrFail($id);
        ${$this->base} = $model;

        view()->share('judul', ($this->judulEdit) ? $this->judulEdit : 'Edit '.ucwords($this->base));
        view()->share('deskripsi', ($this->deskripsiEdit) ? $this->deskripsiEdit : 'Mengedit data '.$this->base);
        view()->share('breadcrumb3', 'Edit');
        view()->share('action', 'postEdit');
        view()->share('params', compact('id'));


        return view("app.{$this->base}.form", compact($this->base));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function postEdit(Request $request, $id)
    {
        $model = $this->model->where($this->model->getKeyName(), $id)->first();
        if ($model == null) {
            abort('404', 'Data not found');
        }
        // $model = $this->model->findOrFail($id);

        $request = $this->processRequest($request);
        
        $this->validate($request, $model->rules());

        $request = $this->processRequestAfterValidation($request);
        
        $updated = $model->update($request->all());

        if ($updated) {
            return redirect($this->base);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function deleteHapus($id)
    {
        $model = $this->model->where($this->model->getKeyName(), $id)->first();
        if ($model == null) {
            abort('404', 'Data not found');
        }
        // $model = $this->model->findOrFail($id);

        $model->delete();

        return redirect($this->base);
    }
}
