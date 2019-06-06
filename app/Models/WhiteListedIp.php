<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class WhiteListedIp extends Model
{
    /**
     * The table associated with the model.
     * @var string
     */
    protected $table = 'white_listed_ips';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'address',
    ];
}
