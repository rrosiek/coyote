<?php
namespace App\Http\Requests;

class UpdateMailList extends Request
{
    /**
     * @return array
     */
    public function rules()
    {
        return [
            'address' => ['required', 'email'],
        ];
    }
}
