<?php

namespace App\Rules;

use Illuminate\Contracts\Validation\Rule;

class DecimaliTreRule implements Rule
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
        if(strlen($value)<3){
            return false;
        }

        if (!preg_match("/^[0-9]$/", $value[0])) {
            return false;
        }
        if (!preg_match("/^[.]$/", $value[1])) {
            return false;
        }
        if (!preg_match("/^[0-9]$/", $value[2])) {
            return false;
        }

        return true;
    }

    /**
     * Get the validation error message.
     *
     * @return string
     */
    public function message()
    {
        return 'Il numero inserito non è valido: ex. 1.234';
    }
}
