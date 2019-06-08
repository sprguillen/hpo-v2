<?php

namespace App\Models;

use DB;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Patient extends Model
{
    use SoftDeletes;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'client_id',
        'code',
        'global_custom_id',
        'hpo_patient_id',
        'client_custom_id',
        'email',
        'first_name',
        'middle_name',
        'last_name',
        'mothers_maiden_name',
        'gender',
        'birth_date',
        'passport_number',
        'citizen',
        'blood_type',
        'address',
        'city',
        'senior_citizen_id',
        'telephone_number',
        'fax_number',
        'mobile_number',
        'occupation',
        'hmo_card',
        'hmo_card_no',
        'last_visit_at',
    ];

    /**
     * Mutators
     */

    /**
     * Find patient by name
     *
     * @param  QueryBuilder $query                              the query builder to use
     * @param  String $name                                     the name to look for
     * @return QueryBuilder
     * @author goper
     */
    public function scopeFindByName($query, $name)
    {
        $name = strtolower($name);
        return $query->where(DB::raw("CONCAT(`first_name`, ' ', `last_name`)"), 'LIKE', '%' . $name . '%')->orWhere("email","like","%$name%");
    }

    /**
     * Relationships
     */

    /**
     * Get user on this service
     *
     * @return Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function client()
    {
        return $this->hasOne(User::class, 'id', 'client_id');
    }
}
