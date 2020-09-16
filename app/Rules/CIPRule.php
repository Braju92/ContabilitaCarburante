<?php

namespace App\Rules;

use Illuminate\Contracts\Validation\Rule;

class CIPRule implements Rule
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
        if(strlen($value)<8){
            return false;
        }

        if (!preg_match("/^[A-Z]$/", $value[0])) {
            return false;
        }
        if (!preg_match("/^[A-Z]$/", $value[1])) {
            return false;
        }
        if (!preg_match("/^[A-Z]$/", $value[2])) {
            return false;
        }
        if (!preg_match("/^[A-Z]$/", $value[3])) {
            return false;
        }
        if (!preg_match("/^[A-Z]$/", $value[4])) {
            return false;
        }
        if (!preg_match("/^[A-Z]$/", $value[5])) {
            return false;
        }
        if (!preg_match("/^[0-9]$/", $value[6])) {
            return false;
        }
        if (!preg_match("/^[0-9]$/", $value[7])) {
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
        return 'Il CIP inserito non è valido: ex. AABBCC11';
    }
}
