<?php
namespace App\Http\Requests;

class StoreCorrespondence extends Request
{
    /**
     * @return array
     */
    public function rules()
    {
        return [
            'subject' => ['required', 'max:255'],
            'body' => ['required'],
        ];
    }
}
