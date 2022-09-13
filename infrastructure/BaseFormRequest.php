<?php
namespace Infrastructure;

use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;
use Illuminate\Http\JsonResponse;
use Illuminate\Validation\ValidationException;

class BaseFormRequest extends FormRequest
{
    protected function failedValidation(Validator $validator)
    {
        if($this->is('api/*')){
            $errors = (new ValidationException($validator))->errors();
            $message = array_values($errors)[0][0];
            throw new HttpResponseException(
                response()->json(
                    [
                        'error' => [
                            'message' => $message
                        ],
                        'status_code' => 422,
                    ],
                    JsonResponse::HTTP_UNPROCESSABLE_ENTITY)
            );
        }else{
            parent::failedValidation($validator);
        }
    }
}
