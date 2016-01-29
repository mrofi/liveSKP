<?php

namespace App;

class SKP extends BaseModel
{
    protected $table = 'skp';
        
    protected $fillable = ['id', 'periode_id', 'pns_nip', 'penilai_nip', 'tanggal_penilaian'];

    public $dependencies = ['periode', 'pns', 'penilai'];

    public function periode()
    {
        return $this->belongsTo(Periode::class);
    }

    public function pns()
    {
        return $this->belongsTo(PNS::class, 'nip', 'nip');
    }

    public function penilai()
    {
        return $this->belongsTo(PNS::class, 'nip', 'nip');
    }

}
