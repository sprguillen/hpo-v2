<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class LabTest extends Model
{
    /**
     * The table associated with the model.
     * @var string
     */
    protected $table = 'lab_tests';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'lab_transaction_id',
        'service_id',
        'samples',
        'cost',
    ];
}
