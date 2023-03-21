<?php

namespace App\Rules;

use Illuminate\Contracts\Validation\Rule;

class CnicNumber implements Rule
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

    /**
     * Determine if the validation rule passes.
     *
     * @param  string  $attribute
     * @param  mixed  $value
     * @return bool
     */
    public function passes($attribute, $value)
    {
        $re = '/^[0-9+]{5}-[0-9+]{7}-[0-9]{1}$/m';
        return preg_match($re, $value);
    }

    /**
     * Get the validation error message.
     *
     * @return string
     */
    public function message()
    {
        return 'Invalid Cnic Number. Use the above pattern';
    }
}
