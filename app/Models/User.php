<?php
namespace App\Models;

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
        'activate_token',
        'password',
        'remember_token',
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
}
