<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class HomePage extends Model
{
     /**
     * @var array
     */
    protected $fillable = [
        'snippet',
        'detail',
    ];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function updatedBy()
    {
        return $this->belongsTo(User::class);
    }
}
