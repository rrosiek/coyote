<?php
namespace App\Http\Middleware;

use Closure;
use Illuminate\Foundation\Http\Middleware\TransformsRequest;

class SplitTextareaEmails extends TransformsRequest
{
    /**
     * @param  string $key
     * @param  mixed $value
     * @return mixed
     */
    protected function transform($key, $value)
    {
        if ($key === 'members') {
            return collect(explode('\n', $value))->map(function ($email) {
                return trim($email);
            });
        }

        return $value;
    }
}
