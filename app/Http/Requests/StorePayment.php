<?php
namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StorePayment extends FormRequest
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
