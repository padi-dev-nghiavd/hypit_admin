<?php

namespace Modules\Creator\Http\Requests;

use App\Rules\PhoneNumberRule;
use Illuminate\Foundation\Http\FormRequest;
use Infrastructure\BaseFormRequest;

class CreatorRequest extends BaseFormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'name' => [
                'required',
                'regex:/^$/'
            ],
            'email' => [
                'required',
                'email'
            ],
            'phone_number' => [
                'required',
                new PhoneNumberRule()
            ],
            'username' => [
                'required',
            ],
            'password' => [
                'required',
                'confirmed',
                'min:6'
            ]
        ];
    }

    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }
}
