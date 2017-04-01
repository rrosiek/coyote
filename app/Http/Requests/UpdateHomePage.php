<?php
namespace App\Http\Requests;

class UpdateHomePage extends Request
{
    /**
     * @return array
     */
    public function rules()
    {
        return [
            'image' => ['sometimes', 'image'],
            'snippet' => ['sometimes'],
            'details' => ['sometimes'],
        ];
    }
}