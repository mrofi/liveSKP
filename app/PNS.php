<?php

namespace App;

use Carbon\Carbon;

class PNS extends BaseModel
{
    protected $table = 'pns';
    protected $primaryKey = 'nip';
    protected $fillable = ['nip', 'nama', 'alamat', 'jenis_kelamin', 'telp', 'email', 'tmt', 'jabatan_id', 'dinas_id', 'user_id'];
    protected $dates = ['tmt'];
    protected $dependencies = ['jabatan', 'dinas'];
    protected $rules = [
    	'nip' => 'required|numeric',
    	'nama' => 'required',
    	'alamat' => 'required',
    	'jenis_kelamin' => 'required',
    	'telp' => 'required',
    	'email' => 'required|email',
    	'tmt' => 'required|date',
    ];

    const LAKILAKI = 'L';
    const PEREMPUAN = 'P';

    public static function getJenisKelamin()
    {
    	return [static::LAKILAKI => 'Laki-laki', static::PEREMPUAN => 'Perempuan'];
    }

    public function jabatan()
    {
    	return $this->belongsTo(Jabatan::class);
    }

    public function dinas()
    {
    	return $this->belongsTo(Dinas::class);
    }

    public function user()
    {
    	return $this->belongsTo(User::class);
    }

    public function getTmtAttribute($value)
    {
    	return (new Carbon($value))->format('d-F-Y');
    }

}
