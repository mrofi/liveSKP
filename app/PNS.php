<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class PNS extends Model
{
    protected $table = 'pns';
    protected $fillable = ['nama', 'alamat', 'jenis_kelamin', 'telp', 'email', 'tmt', 'jabatan_id', 'dinas_id', 'user_id'];
    protected $dates = ['tmt'];
}
