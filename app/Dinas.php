<?php

namespace App;

class Dinas extends BaseModel
{
	protected $table = 'dinas';
    protected $fillable = ['dinas', 'alamat', 'telp', 'email'];

    protected $rules = [
    	'dinas' => 'required',
    	'alamat' => 'required',
    	'telp' => 'required',
    	'email' => 'required|email',

    ];

    public function pns()
    {
    	return $this->hasMany(PNS::class);
    }
}
