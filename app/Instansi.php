<?php

namespace App;

class Instansi extends BaseModel
{
    protected $table = 'instansi';
    protected $fillable = ['instansi', 'alamat', 'telp', 'email'];

    protected $rules = [
        'instansi' => 'required',
        'alamat' => 'required',
        'telp' => 'required',
        'email' => 'required|email',

    ];

    public function pns()
    {
        return $this->hasMany(PNS::class);
    }
}
