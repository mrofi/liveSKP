<?php

namespace App;

class SKP extends BaseModel
{
    protected $table = 'skp';
        
    protected $fillable = ['id', 'periode_id', 'pns_id', 'penilai_id', 'nilai', 'tanggal_penilaian'];

    public $dependencies = ['periode', 'pns', 'penilai'];

    public function periode()
    {
        return $this->belongsTo(Periode::class);
    }

    public function pns()
    {
        return $this->belongsTo(PNS::class, 'pns_id', 'id');
    }

    public function penilai()
    {
        return $this->belongsTo(PNS::class, 'penilai_id', 'id');
    }

    public function targetKerja()
    {
        return $this->hasMany(TargetKerja::class, 'skp_id');
    }
}
