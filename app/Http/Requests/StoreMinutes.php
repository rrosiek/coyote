<?php
namespace App\Http\Requests;

class StoreMinutes extends Request
{
    /**
     * @return array
     */
    public function rules()
    {
        return [
            'meeting_date' => ['required', 'date_format:n/j/Y'],
            'document' => ['required', 'file', 'mimes:doc,docx,pdf'],
        ];
    }
}
