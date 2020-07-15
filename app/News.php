<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class News extends Model
{
    protected $fillable = [
        'name', 'type', 'codigo', 'url','preco','iva','origem','update_time', 'update_version',
    ];
}
