<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Validation\ValidationException;
use Symfony\Component\HttpFoundation\JsonResponse;
use Illuminate\Http\Exceptions\HttpResponseException;

abstract class ApiRequest extends FormRequest
{

    abstract public function authorize(): bool ;
     
    
    abstract public function rules();


    protected function failedValidation(Validator $validator)
    {
        $errors = (new ValidationException($validator))->errors();
       if (!empty($errors) )
       {
            $transformedErrors = [];
            foreach($errors as $field => $message)
            {
                $transformedErrors[] = [
                    $field => $message[0]
                ];

            }
            throw new HttpResponseException(
                response()->json([
                    'status' => 'error',
                    'errors' => $transformedErrors
                ],
                    JsonResponse::HTTP_BAD_REQUEST
                )
            );
       }
    }
   
}
