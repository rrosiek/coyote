<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Newsletter extends Model
{
    /**
     * @var array
     */
    protected $fillable = ['name'];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\MorphOne
     */
    public function upload()
    {
        return $this->morphOne(Upload::class, 'uploadable');
    }
}
