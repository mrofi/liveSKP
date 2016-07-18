<?php

namespace App;

use Carbon\Carbon;

class Penilaian extends BaseModel
{
    protected $table = 'penilaian';

    protected $fillable = ['penilai_id', 'target_kerja_id', 'kuantitas', 'kualitas', 'waktu', 'biaya'];


    public function targetKerja()
    {
        $this->belongsTo(TargetKerja::class);
    }

    public static function boot()
    {
        parent::boot();

        static::saved(function ($model) {
            
            $targetKerja = TargetKerja::find($model->attributes['target_kerja_id']);
            // hitung nilai
            
            $nilais = [];

            if ($targetKerja->kuantitas) {
                // 1. Kuantitas = Realisasi Output / Target Output * 100
                $nilais[] = $kuantitas = $model->attributes['kuantitas'] / $targetKerja->kuantitas * 100;
            }

            if ($targetKerja->kualitas) {
                // 2. Kualitas = Realisasi Output / Target Output * 100
                $nilais[] = $kualitas = $model->attributes['kualitas'] / $targetKerja->kualitas * 100;
            }

            if ($targetKerja->waktu) {
                // 3. Waktu = (1.76 * Target Waktu - Realisasi Waktu) / Target Waktu * 100
                $nilais[] = $waktu = (1.76 * $targetKerja->waktu - $model->attributes['waktu']) / $targetKerja->waktu * 100;
            }

            if ($targetKerja->biaya) {
                // 4. Biaya = (1.76 * Target Biaya - Realisasi Biaya) / Target Biaya * 100
                $nilais[] = $biaya = (1.76 * $targetKerja->biaya - $model->attributes['biaya']) / $targetKerja->biaya * 100;
            }

            $total_nilai = collect($nilais)->sum();

            $score = Score::firstOrNew(['target_kerja_id' => $targetKerja->id]);
            $score->fill(compact('kuantitas', 'kualitas', 'waktu', 'biaya', 'total_nilai'));
            $targetKerja->score()->save($score);

            $nilai = collect($nilais)->average();

            $targetKerja->update(compact('nilai'));
        });
    }
}
