<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Dinas extends BaseModel
{
	protected $table = 'dinas';
    protected $fillable = ['dinas', 'alamat', 'telp', 'email'];

    public function pns()
    {
    	return $this->hasMany(PNS::class);
    }
}
