<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Payment extends Model
{
     /**
     * @var array
     */
    protected $fillable = [
        'email',
        'name',
        'zip',
        'product',
        'amount',
        'cc_brand',
        'cc_lastfour',
        'token',
    ];
}
