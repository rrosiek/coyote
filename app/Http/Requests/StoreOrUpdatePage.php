<?php
namespace App\Http\Requests;

class StoreOrUpdatePage extends Request
{
    /**
     * @return array
     */
    public function rules()
    {
        return [
            'image' => ['sometimes', 'image'],
            'title' => ['sometimes', 'required', 'max:255'],
            'slug' => ['sometimes', 'required', 'alpha_dash', 'max:255'],
            'snippet' => ['sometimes', 'required'],
            'detail' => ['sometimes', 'required'],
        ];
    }
}