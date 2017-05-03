<?php
namespace App\Http\Requests;

class StoreFile extends Request
{
    /**
     * @return array
     */
    public function rules()
    {
        return [
            'description' => ['required', 'max:255'],
            'file' => ['required', 'file'],
        ];
    }
}
