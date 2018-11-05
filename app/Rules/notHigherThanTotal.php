<?php

namespace App\Rules;

use Illuminate\Contracts\Validation\Rule;
use App\Vaccins;
use App\Stock;

class notHigherThanTotal implements Rule
{
    private $vaccine;

    /**
     * Create a new rule instance.
     *
     * @return void
     */
    public function __construct($vaccine_id = null)
    {
        if($vaccine_id)
            $this->vaccine = Vaccins::find($vaccine_id);
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
        if(! $this->vaccine)
            return false;
        
        if(!is_numeric($value))
            return false;

        $total = Stock::where([
                ['vaccine_id', $this->vaccine->id]
            ])
            ->sum('quantity');
   
        return ($total + $value) < $this->vaccine->total_stock;
    }

    /**
     * Get the validation error message.
     *
     * @return string
     */
    public function message()
    {
        return 'Onvoldoende voorraad.';
    }
}
