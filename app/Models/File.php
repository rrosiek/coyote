<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class File extends Model
{
    /**
     * @var array
     */
    protected $fillable = ['description'];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\MorphOne
     */
    public function upload()
    {
        return $this->morphOne(Upload::class, 'uploadable');
    }
}
