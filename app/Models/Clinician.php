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
     * Get the batch
     *
     * @author goper
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
     public function batch()
     {
         return $this->belongsTo(Batch::class);
     }
}
