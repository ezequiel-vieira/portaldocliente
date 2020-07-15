<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    public $timestamps = true;

    protected $fillable = [
        'name',
        'short_name',
        'type',
        'subtype',
        'alias_subtype',
        'subfamily',
        'alias_subfamily',
        'number',
        'url',
        'doc_url',
        'preco',
        'preco_uni',
        'preco_kg',
        'preco_uni_kg',
        'preco_iva',
        'preco_uni_iva',
        'iva',
        'origem',
        'brand',
        'peso_un',
        'peso_cx',
        'peso_kg',
        'peso_venda',
        'unit',
        'catalogo_type',
        'update_time', 
        'update_version'
    ];
}
