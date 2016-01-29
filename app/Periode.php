<?php

namespace App;

class Periode extends BaseModel
{
    protected $table = 'periode';

    protected $fillable = ['awal', 'akhir'];
}
