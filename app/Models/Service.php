<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use DB;

class Service extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'code',
        'name',
        'default_cost'
    ];

    /**
     * Get services of client
     *
     * @return Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function clients()
    {
        return $this->belongsToMany(User::class, 'client_services', 'service_id', 'user_id');
    }

    /**
     * Get lab tests on this service
     *
     * @return Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function tests()
    {
        return $this->hasMany(LabTest::class);
    }

    /**
     * Find service by name or code
     *
     * @param  QueryBuilder $query                              the query builder to use
     * @param  String $name                                     the name to look for
     * @return QueryBuilder
     * @author goper
     */
    public function scopeSearch($query, $key)
    {
        $key = strtolower($key);
        return $query->where('name', 'LIKE', '%' . $key . '%')->orWhere("code","like","%$key%");
    }
}
