<?php
namespace App\Http\Requests;

class StoreMailList extends Request
{
    /**
     * @return array
     */
    public function rules()
    {
        return [
            'name' => ['required', 'max:255'],
            'access_level' => ['required', 'in:everyone,members'],
        ];
    }
}
