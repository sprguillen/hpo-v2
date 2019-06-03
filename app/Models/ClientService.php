<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ClientService extends Model
{
    protected $table = "client_services";

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'user_id',
        'service_id',
        'price',
    ];

    /**
     * Relationships
     */

    /**
     * Get user on this service
     *
     * @return Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function user()
    {
        return $this->hasOne(User::class, 'id', 'user_id');
    }

    /**
     * Get service on this client
     *
     * @return Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function service()
    {
        return $this->hasOne(Service::class, 'id', 'service_id');
    }
}
