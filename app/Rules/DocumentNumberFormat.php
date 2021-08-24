<?php

namespace App\Rules;

use Illuminate\Contracts\Validation\Rule;

class DocumentNumberFormat implements Rule
{
    /**
     * Create a new rule instance.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    function isContainLetters($string)
    {
        return preg_match('/[a-zA-Z]/', $string);
    }

    // Does string contain numbers?
    function isContainNumbers($string)
    {
        return preg_match('/\d/', $string);
    }


    public function isContainNumberAndLetter($value)
    {
        return $this->isContainLetters($value) && $this->isContainNumbers($value);
    }

    /**
     * Determine if the validation rule passes.
     *
     * @param  string  $attribute
     * @param  mixed  $value
     * @return bool
     */
    public function passes($attribute, $value)
    {
        if ($this->isContainNumberAndLetter($value)) {
            return true;
        } else {
            return false;
        }
    }

    /**
     * Get the validation error message.
     *
     * @return string
     */
    public function message()
    {
        return 'No Surat harus mengandung angka dan huruf';
    }
}
