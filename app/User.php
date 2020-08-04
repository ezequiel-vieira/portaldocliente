<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable implements MustVerifyEmail
{
    use Notifiable;

    //Add admin and default types to your User model
    const ADMIN_TYPE        = 'admin';
	const DEFAULT_TYPE      = 'default';
    const CHILD_TYPE        = 'child';
    const GUEST_TYPE        = 'guest';
    const VENDEDOR_TYPE     = 'vendedor';
    const CLIONLINE_TYPE    = 'clionline';

	public function isAdmin()
    {
	    return $this->type === self::ADMIN_TYPE;
	}
    public function isVendedor()
    {
        return $this->type === self::VENDEDOR_TYPE;
    }
    public function isGuest()
    {
        return $this->type === self::GUEST_TYPE;
    }
    public function isClionline()
    {
        return $this->type === self::CLIONLINE_TYPE;
    }
    public function isDefault()
    {
        return $this->type === self::DEFAULT_TYPE;
    }
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name',
        'username', 
        'alias', 
        'email', 
        'id_sap',
        'parent_id', 
        'password', 
        'email_verified_at',
        'update_time', 
        'update_version', 
        'type', 
        'owner_page',
        'users_page',
        'cco_page',
        'refunds_page',
        'orders_page',
        'cat_page',
        'cat_page_lite',
        'news_page',
        'newsletter',
        'hot_news',
        'perfil_page',
        'client_form_page'
    ];
    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];
    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];
    //ONE TO ONE RELATIONSHIP
    public function account()
    {
        return $this->hasOne('App\Account');
    }
    //ONE(USERS) TO MANY(current_accounts) RELATIONSHIP
    public function current_account()
    {
        return $this->hasMany('App\Current_account', 'user_id');
    }
    /**
     * Get the documents from the USER.
     */
    public function documents()
    {
        return $this->hasMany('App\Document', 'users_id');
    }
}
