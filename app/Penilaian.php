<?php

namespace App;

use Carbon\Carbon;

class Penilaian extends BaseModel
{
    protected $table = 'penilaian';

    protected $fillable = ['penilai_nip', 'target_kerja_id', 'kuantitas', 'kualitas', 'waktu', 'biaya'];


    public function targetKerja()
    {
        $this->belongsTo(TargetKerja::class);
    }

    public static function boot()
    {
        parent::boot();

        static::saved(function($model)
        {
            $targetKerja = TargetKerja::find($model->attributes['target_kerja_id']);
            $skp = SKP::find($targetKerja->attributes['skp_id']);
            if ($skp->tanggal_penilaian == null) {
                $skp->update(['tanggal_penilaian' => Carbon::now()]);
            }
        });
    }

}
