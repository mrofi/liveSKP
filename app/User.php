<?php

namespace App;

use Illuminate\Foundation\Auth\User as Authenticatable;
use LiveCMS\Support\Thumbnailer\Contracts\ModelThumbnailerInterface;
use LiveCMS\Support\Thumbnailer\ModelThumbnailerTrait;
use LiveCMS\Support\Uploader\Contracts\ModelUploaderInterface;
use LiveCMS\Support\Uploader\ModelUploaderTrait;

class User extends Authenticatable implements BaseModelInterface, ModelUploaderInterface, ModelThumbnailerInterface
{
    use BaseModelTrait, ModelUploaderTrait, ModelThumbnailerTrait;
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password', 'deskripsi', 'foto', 'is_admin'
    ];

    /**
     * The attributes excluded from the model's JSON form.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    protected $table = 'pengguna';

    protected $dependencies = [];

    protected $rules = [];

    protected $files = ['foto'];

    protected $images = ['foto'];


    public function getInitial()
    {
        $name = strtoupper($this->name);

        $words = count($names = explode(' ', $name));

        $inits = array_map(function($value) {
            return substr($value, 0, 1);
        }, $names);

        $initials = $inits[0]. ($words > 1 ?  last($inits) : '');

        return $initials;
    }

    public function pns()
    {
        return $this->hasOne(PNS::class, 'pengguna_id', 'id')->with(['atasan', 'jabatan', 'instansi', 'skps']);
    }

}
