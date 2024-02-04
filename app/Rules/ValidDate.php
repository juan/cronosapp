<?php

namespace App\Rules;

use DateTime;
use Illuminate\Contracts\Validation\Rule;

class ValidDate implements Rule
{
    protected $format;

    protected $date;

    /**
     * Create a new rule instance.
     *
     * @return void
     */
    public function __construct($format, $date)
    {
        $this->format = $format;
        $this->date = $date;
    }

    /**
     * Determine if the validation rule passes.
     *
     * @param  string  $attribute
     * @return bool
     */
    public function passes($attribute, $value)
    {
        $dateTime = DateTime::createFromFormat($this->format, $this->date);
        $z = $dateTime && $dateTime->format($this->format) === $this->date;

        return $z;
    }

    /**
     * Get the validation error message.
     *
     * @return string
     */
    public function message()
    {
        return 'Fecha no validad.';
    }
}
