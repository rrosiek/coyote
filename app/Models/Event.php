<?php
namespace App\Models;

use Carbon\Carbon;
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
        'until',
    ];

    /**
     * @array
     */
    protected $dates = [
        'start_date',
        'end_date',
        'until',
        'created_at',
        'updated_at',
    ];

    /**
     * We still want to store in UTC, but site frontend based on America/New_York
     *
     * @param  string $date
     */
    // public function setEndDateAttribute($date)
    // {
        // $this->attributes['end_date'] = (new Carbon($date, 'America/New_York'))->timezone('UTC');
    // }

    /**
     * We still want to store in UTC, but site frontend based on America/New_York
     *
     * @param  string $date
     */
    // public function setStartDateAttribute($date)
    // {
        // $this->attributes['start_date'] = (new Carbon($date, 'America/New_York'))->timezone('UTC');
    // }

    /**
     * We still want to store in UTC, but site frontend based on America/New_York
     *
     * @param  string $date
     */
    // public function setUntilAttribute($date)
    // {
        // $this->attributes['until'] = (new Carbon($date, 'America/New_York'))->timezone('UTC');
    // }
}
