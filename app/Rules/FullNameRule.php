<?php

namespace App\Rules;

use Closure;
use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Translation\PotentiallyTranslatedString;

class FullNameRule implements ValidationRule
{
    /**
     * Checks full name attribute structure -
     * has at least First and Last name
     *
     * @param string $attribute
     * @param mixed $value
     * @param \Closure(string): PotentiallyTranslatedString $fail
     */
    public function validate(string $attribute, mixed $value, Closure $fail): void
    {
        $fullNameSplit = explode(' ', $value);
        if (count($fullNameSplit) === 1) {
            $fail('The :attribute must have at least first and last name');
        }
        if (count($fullNameSplit) > 3) {
            $fail('Sorry, the :attribute can have maximum 3 parts');
        }
    }
}
