<?php

namespace App\Rules;

use Illuminate\Contracts\Validation\Rule;

class PhoneNumberRule implements Rule
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
        $arrayHeadNumber = [
            '086', '096', '097', '098', '032', '033', '034', '035', '036', '037', '038', '039',
            '089', '090', '093', '070', '079', '077', '076', '078',
            '088', '091', '094', '083', '084', '085', '081', '082',
            '092', '056', '058',
            '099', '059',
            '095'
        ];

        if(isset($value) && $value){
            $subValue = substr($value, 0, 3);
            $valueHeadNumber = in_array($subValue, $arrayHeadNumber);

            return preg_match('/^([0-9]{10})$/', $value) && $valueHeadNumber;
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
        return trans('validation.invalid', [
            'attribute' => ucfirst(trans('common.phone_number'))
        ]);
    }
}
