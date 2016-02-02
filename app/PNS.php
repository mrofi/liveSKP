<?php

namespace App;

use Carbon\Carbon;

class PNS extends BaseModel
{
    protected $table = 'pns';
    protected $primaryKey = 'nip';
    protected $fillable = ['nip', 'nama', 'alamat', 'jenis_kelamin', 'telp', 'email', 'tmt', 'jabatan_id', 'dinas_id', 'pengguna_id', 'atasan_nip'];
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

    protected $aliases = [
        'tmt' => 'TMT',
        'jabatan_id' => 'Jabatan',
        'dinas_id' => 'Dinas',
    ];

    const LAKILAKI = 'L';
    const PEREMPUAN = 'P';

    public static function boot()
    {
        parent::boot();

        static::saving(function($model)
        {
            $user = $model->user ?: User::create();
            $user->update([
                'name' => $model->attributes['nama'],
                'email' => $model->attributes['email'],
                'password' => $user->password ? $user->password : bcrypt('abdinegara'),
            ]);

            $model->attributes['pengguna_id'] = $user->id;
        });
    }

    public function getFillable()
    {
        $fillable = parent::getFillable();

        return array_flip(array_except(array_flip($fillable), ['pengguna_id', 'atasan_nip']));
    }

    public static function getJenisKelamin()
    {
    	return [static::LAKILAKI => 'Laki-laki', static::PEREMPUAN => 'Perempuan'];
    }

    public function atasan()
    {
        return $this->belongsTo(PNS::class, 'atasan_nip', 'nip');
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

    public function skps()
    {
        return $this->hasMany(SKP::class, 'pns_nip');
    }

    public function getNipAttribute($value)
    {
        return "$value";
    }

    public function bawahan()
    {
        return $this->hasMany(PNS::class, 'atasan_nip', 'nip')->with('skps');
    }

}
