<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class ClientStaff extends Model
{
    use SoftDeletes;

    /**
     * Table to be used
     *
     * @{inheritdoc}
     * @var string
     */
    protected $table = "client_staffs";

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'client_id',
        'staff_id',
    ];

    /**
     * Eager loaded relationship
     *
     * @var array
     */
    protected $with = [
        'user',
    ];

    /**
     * Relationships
     */

    /**
     * Get client on this staff
     *
     * @return Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function client()
    {
        return $this->hasOne(User::class, 'id', 'client_id');
    }

    /**
     * Get user data on this staff
     *
     * @return Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function user()
    {
        return $this->hasOne(User::class, 'id', 'staff_id');
    }
}
