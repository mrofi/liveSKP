<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class BaseModel extends Model
{
    use BaseModelTrait;

    protected $dependencies = [];

    protected $rules = [];

    protected $aliases = [];

    public function getKeterangan($nilai = 0)
    {
        if ($nilai == 0) return '-';
        if ($nilai <= 50) return 'Buruk';
        if ($nilai <= 60) return 'Kurang';
        if ($nilai <= 75) return 'Cukup';
        if ($nilai <= 90) return 'Baik';
        return 'Sangat Baik';
    }
}
