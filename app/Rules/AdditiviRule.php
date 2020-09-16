<?php

namespace App\Rules;

use Illuminate\Contracts\Validation\Rule;

class AdditiviRule implements Rule
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

        if(strlen($value)<16){
            return false;
        }

        if (!preg_match("/^[0-9]$/", $value[0])) {
            return false;
        }
        if (!preg_match("/^[0-9]$/", $value[1])) {
            return false;
        }
        if (!preg_match("/^[0-9]$/", $value[2])) {
            return false;
        }
        if (!preg_match("/^[0-9]$/", $value[3])) {
            return false;
        }
        if (!preg_match("/^[.]$/", $value[4])) {
            return false;
        }
        if (!preg_match("/^[0-9]$/", $value[5])) {
            return false;
        }
        if (!preg_match("/^[0-9]$/", $value[6])) {
            return false;
        }
        if (!preg_match("/^[.]$/", $value[7])) {
            return false;
        }
        if (!preg_match("/^[0-9]$/", $value[8])) {
            return false;
        }
        if (!preg_match("/^[0-9]$/", $value[9])) {
            return false;
        }
        if (!preg_match("/^[0-9]$/", $value[10])) {
            return false;
        }
        if (!preg_match("/^[.]$/", $value[11])) {
            return false;
        }
        if (!preg_match("/^[0-9]$/", $value[12])) {
            return false;
        }
        if (!preg_match("/^[0-9]$/", $value[13])) {
            return false;
        }
        if (!preg_match("/^[0-9]$/", $value[14])) {
            return false;
        }
        if (!preg_match("/^[0-9]$/", $value[15])) {
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
        return 'Il codice additivo inserito non è valido: ex. 1234.12.123.1234';
    }
}
