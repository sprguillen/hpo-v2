<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ClientSource extends Model
{
    /**
     * Table to be used
     *
     * @{inheritdoc}
     * @var string
     */
    protected $table = "client_sources";

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'user_id',
        'source_id',
    ];

    /**
     * Relationships
     */

    /**
     * Get user on this sources
     *
     * @return Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function user()
    {
        return $this->hasOne(User::class, 'id', 'user_id');
    }

    /**
     * Get source on this client
     *
     * @return Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function source()
    {
        return $this->hasOne(Source::class, 'id', 'source_id');
    }
}
