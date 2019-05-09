<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Batch extends Model
{
    const STATUS_DRAFT = 0;
    const CONFIRMED = 1;
    const STATUS_ACCOMPLISHED = 2;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'code',
        'source_id',
        'clinician_id',
        'patient_type_id',
        'created_by',
        'dispatch_mode',
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
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function source()
    {
        return $this->hasOne(Source::class);
    }

    /**
     * Get the batch clinician
     *
     * @author goper
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function clinician()
    {
        return $this->hasOne(Clinician::class);
    }

    /**
     * Get the user who created this batch
     *
     * @author goper
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function creator()
    {
        return $this->hasOne(User::class, 'id', 'created_by');
    }

    /**
     * Get batch patient_type
     *
     * @author goper
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function patientType()
    {
        return $this->hasOne(PatientType::class, 'id', 'patient_type_id');
    }
}
