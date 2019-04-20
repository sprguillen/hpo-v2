<?php

namespace App\Models;

use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Tymon\JWTAuth\Contracts\JWTSubject;

class User extends Authenticatable implements JWTSubject
{
    use Notifiable;

    const ROLE_ADMIN = 10;
    const ROLE_CLIENT = 0;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'code',
        'global_prefix',
        'type',
        'username',
        'email',
        'password',
        'first_name',
        'last_name',
        'role',
        'contact_number',
        'business_name',
        'business_address',
        'is_active',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password',
    ];

    /**
     * guarded
     * @var array
     */
    protected $guarded = [
        'code',
        'global_prefix',
        'type',
        'active'
    ];

    /**
     * Get users that are admin
     *
     * @param  \Illuminate\Database\Eloquent\Builder  $query
     * @return \Illuminate\Database\Eloquent\Builder
     * @author goper
     */
    public function scopeAdmin($query) {
        return $query->where('role', self::ROLE_ADMIN);
    }

    /**
     * Get users that are client
     *
     * @param  \Illuminate\Database\Eloquent\Builder  $query
     * @return \Illuminate\Database\Eloquent\Builder
     * @author goper
     */
    public function scopeClient($query) {
        return $query->where('role', self::ROLE_CLIENT);
    }

    /**
     * Is the current user an admin?
     *
     * @author goper
     * @return boolean
     */
    public function isAdmin()
    {
        return $this->role == self::ROLE_ADMIN;
    }

    public function getJWTIdentifier()
    {
      return $this->getKey();
    }

    public function getJWTCustomClaims()
    {
      return [];
    }
}
