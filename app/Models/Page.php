<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Page extends Model
{
     /**
     * @var array
     */
    protected $fillable = [
        'title',
        'slug',
        'snippet',
        'detail',
    ];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function updatedBy()
    {
        return $this->belongsTo(User::class, 'updated_by');
    }
}
