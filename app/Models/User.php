<?php

namespace App\Models;

use App\Events\UserSaved;
use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * @var array
     */
    protected $fillable = [
        'email',
        'password',
        'first_name',
        'last_name',
        'address1',
        'address2',
        'city',
        'state',
        'zip',
        'phone',
        'grad_year',
        'roll_number',
        'employer',
        'subscribed',
    ];

    /**
     * @var array
     */
    protected $hidden = [
        'active',
        'activate_token',
        'email_failed',
        'is_admin',
        'password',
        'remember_token',
        'subscribed',
    ];

    /**
     * @var array
     */
    protected $appends = [
        'avatar_url',
        'full_address',
        'name',
    ];

    /**
     * @var array
     */
    protected $dispatchesEvents = [
        'saving' => UserSaved::class,
    ];

    /**
     * @return string
     */
    public function getFullAddressAttribute()
    {
        return $this->address1 . ' ' . $this->city . ', ' . $this->state . ' ' . $this->zip;
    }

    /**
     * @return string
     */
    public function getNameAttribute()
    {
        return $this->first_name . ' ' . $this->last_name;
    }

    /**
     * @return string
     */
    public function getAvatarUrlAttribute()
    {
        $root = 'https://www.gravatar.com/avatar/';
        $hash = md5(strtolower(trim($this->email)));

        return $root . $hash;
    }

    /**
     * @param \Illuminate\Database\Eloquent\Builder $query
     * @param array $params
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function scopeFilterBy($query, $params)
    {
        if (array_key_exists('filter', $params) and $params['filter']) {
            $query->where(function ($sub) use ($params) {
                $sub->where('first_name', 'like', '%' . $params['filter'] . '%')
                    ->orWhere('last_name', 'like', '%' . $params['filter'] . '%')
                    ->orWhere('email', 'like', '%' . $params['filter'] . '%');
            });
        }

        if (array_key_exists('inactive', $params))
            $query->where('active', false);

        if (array_key_exists('unsubscribed', $params))
            $query->where('subscribed', false);

        if (array_key_exists('admin', $params))
            $query->where('is_admin', true);

        return $query;
    }
}
