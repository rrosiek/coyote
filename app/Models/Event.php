<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Event extends Model
{
     /**
     * @var array
     */
    protected $fillable = [
        'title',
        'detail',
        'start_date',
        'end_date',
        'frequency',
        'interval',
        'by_day',
        'by_set_pos',
        'all_day',
    ];

    /**
     * @array
     */
    protected $dates = [
        'start_date',
        'end_date',
        'created_at',
        'updated_at',
    ];

    /**
     * @var array
     */
    protected $casts = [
        'start_date' => 'date',
        'end_date' => 'date',
        'interval' => 'integer',
        'all_day' => 'boolean',
    ];
}
