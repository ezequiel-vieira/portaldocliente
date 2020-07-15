<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Encomenda extends Model
{
    public $timestamps = true;

    protected $fillable = [
        'cliente',
        'telefone',
        'nif',
        'email',
        'data_entrega',
        'data_encomenda',
        'morada',
        'valor',
        'notas'
    ];
}
