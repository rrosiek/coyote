<?php
namespace App\Http\Requests;

class StoreOrUpdateEvent extends Request
{
    /**
     * @return array
     */
    public function rules()
    {
        return [
            'title' => ['required', 'max:255'],
            'detail' => ['max:255'],
            'start_date' => ['required', 'date_format:n/j/Y'],
            'start_time' => ['max:5'],
            'end_date' => ['nullable', 'date_format:n/j/Y', 'after:start_date'],
            'end_time' => ['max:5'],
            'frequency' => ['nullable', 'in:DAILY,WEEKLY,MONTHLY'],
            'by_day' => ['nullable', 'in:' . implode(",", array_keys(config('custom.days')))],
            'interval' => ['nullable', 'integer'],
            'set_position' => ['nullable', 'integer'],
            'until' => ['required_with:frequency'],
        ];
    }

   /**
    * @return array
    */
    public function messages()
    {
        return [
            'start_date.date_format' => 'A valid date is needed for the start date.',
            'end_date.date_format'  => 'A valid date format is needed for the end date.',
            'until.date_format'  => 'A valid date format is needed for the recurrence end date.',
        ];
    }
}