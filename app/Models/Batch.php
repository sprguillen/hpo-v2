<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Batch extends Model
{
    const DRAFT = 0;
    const CONFIRMED = 1;
    const ACCOMPLISHED = 2;
    
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'code',
        'source_id',
        'clinician_id',
        'created_by',
        'dispatch_mode',
        'patient_type',
        'payment_mode',
        'status',
        'slides',
        'blood',
        'forms',
        'specimen',
    ];

    /**
     * Relationships
     */

    /**
     * Get the batch source
     *
     * @author goper
     */
    public function source()
    {
        return $this->hasOne(Source::class);
    }

    /**
     * Get the batch clinician
     *
     * @author goper
     * @return Relationships
     */
    public function clinician()
    {
        return $this->hasOne(Clinician::class);
    }

    /**
     * Get the user who created this batch
     *
     * @author goper
     * @return Relationships
     */
    public function creator()
    {
        return $this->hasOne(User::class, 'id', 'created_by');
    }
}
