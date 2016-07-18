<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Score extends BaseModel
{
    protected $table = 'score';

    protected $fillable = ['target_kerja_id', 'kuantitas', 'kualitas', 'waktu', 'biaya', 'total_nilai'];

    public function targetKerja()
    {
        return $this->belongsTo(TargetKerja::class);
    }
}
