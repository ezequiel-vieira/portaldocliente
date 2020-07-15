<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Account extends Model
{
    
	public $timestamps = true;

	protected $fillable = [
        'name', 
        'alias',
        'morada',
        'telefone',
        'telemovel',
        'email1', 
        'email2',
        'email3',
        'cod_postal', 
		'localidade',
		'nif',
		'vendedor',
		'vendedor_contato',
		'id_sap',
        'update_time', 
        'update_version', 
        'type', 
        'created_at', 
        'updated_at '
    ];

    public function user()
    {
    	return $this->belongsTo('App\User');
    }
}
