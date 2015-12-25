<?php

namespace App;

class PNS extends BaseModel
{
    protected $table = 'pns';
    protected $fillable = ['nama', 'alamat', 'jenis_kelamin', 'telp', 'email', 'tmt', 'jabatan_id', 'dinas_id', 'user_id'];
    protected $dates = ['tmt'];
}
