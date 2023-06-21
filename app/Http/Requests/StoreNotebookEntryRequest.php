<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreNotebookEntryRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array|string>
     */
    public function rules(): array
    {
        return [
            'full_name' => 'string|required', // todo add rule
            'company_name' => 'string',
            'phone_number' => 'string|required',
            'email' => 'string|required',
            'birth_date' => 'date_format:d-m-Y|before:today',
            'photo' => 'image|max:2048',
        ];
    }

    protected function prepareForValidation()
    {
        // add custom Rule ?? php artisan make:rule SomeRule
    }
}
