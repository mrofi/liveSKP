<?php

namespace App;

class TargetKerja extends BaseModel
{
    protected $table = 'target_kerja';
    
    protected $fillable = ['skp_id', 'tugas', 'angka_kredit', 'kuantitas', 'satuan_kuantitas', 'kualitas', 'satuan_kualitas', 'waktu', 'satuan_waktu', 'biaya', 'satuan_biaya', 'nilai'];

    protected $rules = [
        'tugas' => 'required',
        'kuantitas' => 'required',
        'kualitas' => 'required',
        'waktu' => 'required',
    ];

    protected $dependencies = ['penilaian'];

    public function penilaian()
    {
        return $this->hasOne(Penilaian::class);
    }

    public function skp()
    {
        return $this->belongsTo(SKP::class);
    }
}
