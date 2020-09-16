<?php

namespace App\Rules;

use Illuminate\Contracts\Validation\Rule;

class BetweenNumbers implements Rule
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
       return (float) $value >= 10 && (float) $value <= 100;
    }

    /**
     * Get the validation error message.
     *
     * @return string
     */
    public function message()
    {
        return 'The identifier cannot be less than 10 or more than 100.';
    }
}
