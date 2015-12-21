<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Jabatan extends Model
{
    protected $table = 'jabatan';
    protected $fillable = ['jabatan'];

    public function pns()
    {
    	return $this->hasMany(PNS::class);
    }
}
