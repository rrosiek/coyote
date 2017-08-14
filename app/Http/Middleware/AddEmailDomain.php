<?php
namespace App\Http\Middleware;

use Closure;
use Illuminate\Foundation\Http\Middleware\TransformsRequest;

class AddEmailDomain extends TransformsRequest
{
    /**
     * @param  string $key
     * @param  mixed $value
     * @return mixed
     */
    protected function transform($key, $value)
    {
        if ($key === 'address')
            return $value . '@' . env('MAILGUN_INBOUND_DOMAIN');

        return $value;
    }
}
