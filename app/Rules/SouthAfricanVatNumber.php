<?php

namespace App\Rules;

use Closure;
use Illuminate\Contracts\Validation\ValidationRule;

class SouthAfricanVatNumber implements ValidationRule
{
    /**
     * Run the validation rule.
     *
     * @param  \Closure(string, ?string=): \Illuminate\Translation\PotentiallyTranslatedString  $fail
     */
    public function validate(string $attribute, mixed $value, Closure $fail): void
    {
        // South African VAT number format: starts with '4' and is 10 digits long
        if (! preg_match('/^4\d{9}$/', $value)) {
            $fail('This must be a valid South African VAT number (10 digits starting with 4).');
        }
    }
}
