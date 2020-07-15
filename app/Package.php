<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Package extends Model
{
    public $timestamps = true;

    protected $fillable = [
        'pack_number',
        'pack_date',
        'pack_value',
        'pack_ft_number',
        'update_time', 
        'update_version',
        'users_id'
    ];

    /**
     * Get the USER that owns the document.
     */
    public function user()
    {
        return $this->belongsTo('App\User');
    }
}
