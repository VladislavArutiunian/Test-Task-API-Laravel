<?php

namespace App\Http\Requests;

use App\Rules\FullNameRule;
use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;

class StoreNotepadContactRequest extends FormRequest
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
     * @return array<string, ValidationRule|array|string>
     */
    public function rules(): array
    {
        return [
            'full_name' => ['required', 'string', 'between:5,255', new FullNameRule],
            'company_name' => 'string|between:2,255',
            'phone_number' => ['numeric', 'required', 'unique:notepad_contacts,phone_number', 'digits_between:6,18'],
            'email' => ['email', 'required', 'unique:notepad_contacts,email', 'between:6,255'],
            'birth_date' => ['date_format:d.m.Y', 'before:today'],
            'photo' => 'image|max:2048',
        ];
    }

    public function messages(): array
    {
        return [
            'between' => 'Please provide a valid :attribute',
            'phone_number.digits_between' => 'Please provide a valid phone number',
        ];
    }
}
