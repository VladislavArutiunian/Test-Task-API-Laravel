<?php

namespace App\Http\Requests;

use App\Rules\FullNameRule;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class IndexNotepadContactRequest extends FormRequest
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
            'per_page' => 'numeric|min:1'
        ];
    }
    public function messages()
    {
        return [
            'per.min' => 'The :attribute field must be greater than 0.'
        ];
    }
}
