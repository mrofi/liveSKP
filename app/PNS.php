<?php

namespace App;

use Carbon\Carbon;

class PNS extends BaseModel
{
    protected $table = 'pns';
    protected $fillable = ['nip', 'nama', 'alamat', 'jenis_kelamin', 'telp', 'email', 'tmt', 'jabatan_id', 'instansi_id', 'pengguna_id', 'atasan_id'];
    protected $dates = ['tmt'];
    protected $dependencies = ['jabatan', 'instansi'];
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
        'instansi_id' => 'Instansi',
    ];

    const LAKILAKI = 'L';
    const PEREMPUAN = 'P';

    public static function boot()
    {
        parent::boot();

        static::saving(function ($model) {

            $user = $model->user ?: new User;
            $user->fill([
                'name' => $model->attributes['nama'],
                'email' => $model->attributes['email'],
                'password' => $user->password ? $user->password : bcrypt('abdinegara'),
            ]);
            $user->save();

            $model->attributes['pengguna_id'] = $user->id;
        });
    }

    public function getFillable()
    {
        $fillable = parent::getFillable();

        return array_flip(array_except(array_flip($fillable), ['pengguna_id', 'atasan_id']));
    }

    public static function getJenisKelamin()
    {
        return [static::LAKILAKI => 'Laki-laki', static::PEREMPUAN => 'Perempuan'];
    }

    public function atasan()
    {
        return $this->belongsTo(PNS::class, 'atasan_id');
    }

    public function jabatan()
    {
        return $this->belongsTo(Jabatan::class);
    }

    public function instansi()
    {
        return $this->belongsTo(Instansi::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'pengguna_id');
    }

    public function skps()
    {
        return $this->hasMany(SKP::class, 'pns_id');
    }

    public function getNipAttribute($value)
    {
        return "$value";
    }

    public function bawahan()
    {
        return $this->hasMany(PNS::class, 'atasan_id')->with('skps');
    }
}
