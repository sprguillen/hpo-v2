<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Clinician extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'user_id',
        'name',
    ];

    /**
     * Relationships
     */

    /**
     * Get the user that is a clinician
     *
     * @author goper
     * @return Relationships
     */
     public function user()
     {
         return $this->belongsTo(User::class);
     }
}
