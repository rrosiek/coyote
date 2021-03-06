<?php
namespace App\Http\Requests;

class StorePayment extends Request
{
    /**
     * @return array
     */
    public function rules()
    {
        return [
            'brand' => ['required', 'max:255'],
            'email' => ['required', 'email'],
            'lastFour' => ['required', 'integer'], 
            'name' => ['required', 'max:255'],
            'product' => ['required', 'max:255'],
            'token' => ['required', 'max:255'],
            'payment' => ['required', 'integer'],
            'zip' => ['required', 'max:255'],
        ];
    }
}
