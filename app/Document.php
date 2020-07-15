<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Document extends Model
{
    public $timestamps = true;

    protected $fillable = [
        'doc_number',
        'doc_date',
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
