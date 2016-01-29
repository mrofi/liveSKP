<?php

namespace App;

class Penilaian extends BaseModel
{
    protected $table = 'penilaian';

    protected $fillable = ['penilai_nip', 'target_kerja_id', 'kuantitas', 'kualitas', 'waktu', 'biaya'];
}
