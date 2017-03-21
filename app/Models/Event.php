<?php
namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
use RRule\RRule;

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
     * Gets full list of events using RRule
     *
     * @param  integer $limit
     * @return \Illuminate\Support\Collection
     */
    public static function list($limit = 10)
    {
        $start = new Carbon();
        $events = new static();

        return $events->where('until', '>=', $start)
            ->orWhere(function ($sub) use ($start) {
                $sub->where('start_date', '>=', $start)->whereNull('until');
            })
            ->get()
            ->flatMap(function ($e) {
                return array_map(function ($rule) use ($e) {
                    return [
                        'title' => $e->title,
                        'detail' => $e->detail,
                        'start' => new Carbon($rule->format('Y-m-d H:i:s')),
                        'end' => $e->end_date ? (new Carbon($e->end_date))->diffForHumans(new Carbon($e->start_date), true) : null,
                        'allDay' => $e->all_day,
                    ];
                }, (new RRule([
                    'DTSTART' => $e->start_date,
                    'UNTIL' => $e->until ? $e->until->toDateString() : null,
                    'COUNT' => $e->until ? null : 1,
                    'FREQ' => $e->frequency ?: 'YEARLY',
                    'INTERVAL' => $e->interval,
                    'BYDAY' => $e->by_day,
                    'BYSETPOS' => $e->by_set_pos,
                ]))->getOccurrences());
            })
            ->sortBy('start')
            ->take($limit);
    }
}
