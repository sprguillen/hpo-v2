<?php

namespace App\Models;

use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Laravel\Passport\HasApiTokens;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use Notifiable, HasApiTokens;

    const ROLE_ADMIN = 10;
    const ROLE_CLIENT = 0;
    const ROLE_PROCESSOR = 1;
    const ROLE_PATIENT = 2;
    const ROLE_STAFF = 3;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'code',
        'global_prefix',
        'username',
        'email',
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
        'remember_token'
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
     * Get users that are `processors` role
     *
     * @param  \Illuminate\Database\Eloquent\Builder  $query
     * @return \Illuminate\Database\Eloquent\Builder
     * @author goper
     */
    public function scopeProcessor($query) {
        return $query->where('role', self::ROLE_PROCESSOR);
    }

    /**
     * Is the current user an admin
     *
     * @return boolean
     * @author goper
     */
    public function getIsAdminAttribute()
    {
        return $this->isAdmin();
    }

    /**
     * Is the current user an client
     *
     * @return boolean
     * @author goper
     */
    public function getIsClientAttribute()
    {
        return $this->role == self::ROLE_CLIENT;
    }

    /**
     * Is the current user is not admin?
     *
     * @return boolean
     */
    public function getIsNotAdminAttribute()
    {
        return !$this->isAdmin();
    }

    /**
     * Custom methods
     */

    /**
     * Is the current user an admin?
     *
     * @return boolean
     * @author goper
     */
    public function isAdmin() {
        return $this->role == self::ROLE_ADMIN;
    }
}
