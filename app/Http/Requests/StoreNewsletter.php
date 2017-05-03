<?php
namespace App\Http\Requests;

class StoreNewsletter extends Request
{
    /**
     * @return array
     */
    public function rules()
    {
        return [
            'name' => ['required', 'max:255'],
            'document' => ['required', 'file', 'mimes:doc,docx,pdf'],
        ];
    }
}
