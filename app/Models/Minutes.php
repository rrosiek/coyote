<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Minutes extends Model
{
    /**
     * @var array
     */
    protected $fillable = ['meeting_date'];

    /**
     * @var array
     */
    protected $dates = [
        'meeting_date',
        'created_at',
        'updated_at',
    ];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\MorphOne
     */
    public function upload()
    {
        return $this->morphOne(Upload::class, 'uploadable');
    }
}
