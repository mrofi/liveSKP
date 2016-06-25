<?php

namespace App;

class Jabatan extends BaseModel
{
    const STRUKTURAL = 'struktural';
    const FUNGSIONAL = 'fungsional';
    
    protected $table = 'jabatan';
    protected $fillable = ['jabatan', 'status'];

    public function pns()
    {
        return $this->hasMany(PNS::class);
    }
}
