<?php

namespace App;

class Jabatan extends BaseModel
{
    protected $table = 'jabatan';
    protected $fillable = ['jabatan', 'struktural'];

    public function pns()
    {
    	return $this->hasMany(PNS::class);
    }
}
