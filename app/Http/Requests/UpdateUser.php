<?php
namespace App\Http\Requests;

use Illuminate\Validation\Rule;

class UpdateUser extends Request
{
    /**
     * @return array
     */
    public function rules()
    {
        return [
            'email' => ['required', 'email', 'max:255'],
            'first_name' => ['required', 'max:255'],
            'last_name' => ['required', 'max:255'],
            'address1' => ['max:255'],
            'address2' => ['max:255'],
            'city' => ['max:255'],
            'state' => [Rule::in(array_keys(config('custom.states')))],
            'zip' => ['max:255'],
            'phone' => ['max:255'],
            'grad_year' => ['nullable', 'integer', 'min:1985' ,'max:2100'],
            'roll_number' => ['nullable' , 'integer', 'min:0', 'max:5000'],
            'employer' => ['max:255'],
            'big' => ['integer'],
        ];
    }
}
