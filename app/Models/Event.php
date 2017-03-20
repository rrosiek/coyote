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
     * @param  \Illuminate\Database\Eloquent\Builder $query
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function scopeActive($query)
    {
        $start = new Carbon();

        return $query->where('until', '>=', $start)
            ->orWhere(function ($sub) use ($start) {
                $sub->where('start_date', '>=', $start)->whereNull('until');
            });
    }
}
