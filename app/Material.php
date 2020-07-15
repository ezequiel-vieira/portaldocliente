<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Material extends Model
{
    public $timestamps = true;

    protected $fillable = [
        'name',
        'type',
        'number',
        'url',
        'update_time', 
        'update_version'
    ];
}
