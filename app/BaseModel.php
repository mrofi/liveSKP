<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class BaseModel extends Model
{
    use BaseModelTrait;

    protected $dependencies = [];

    protected $rules = [];

    protected $aliases = [];
}
