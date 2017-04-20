<?php
namespace App\Models;

use App\Models\User;
use Illuminate\Database\Eloquent\Model;

class Correspondence extends Model
{
    /**
     * @var string
     */
    protected $table = 'correspondence';

    /**
     * @var array
     */
    protected $fillable = [
        'subject',
        'body',
    ];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function author()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
}
