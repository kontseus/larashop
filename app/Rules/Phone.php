<?php

namespace App\Rules;

use Illuminate\Contracts\Validation\Rule;

class Phone implements Rule
{
    /**
     * Determine if the validation rule passes.
     *
     * @param  string  $attribute
     * @param  mixed  $value
     * @return bool
     */
    public function passes($attribute, $value)
    {
        // +38(066)4221133
        preg_match('/\+[0-9]{2}\([0-9]{3}\)[0-9]{7}/', $value, $matches);
        return !empty($matches);
    }

    /**
     * Get the validation error message.
     *
     * @return string
     */
    public function message()
    {
        return 'The pattern of phone number have to be equal "+XX(XXX)XXXXXXX".';
    }
}
