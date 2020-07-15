<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Current_account extends Model
{
    protected $fillable = [
        'user_id',
        'doc_type',
		'doc_tag',
		'doc_number',
		'doc_date',
		'payment_type',
		'payment_date',
		'doc_value',
		'update_time',
		'update_version',
		'update_time', 
        'update_version', 
        'created_at', 
        'updated_at '
    ];

    public function user()
    {
    	return $this->belongsTo('App\User');
    }
}
