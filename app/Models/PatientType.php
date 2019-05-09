<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PatientType extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'code',
        'name'
    ];

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
