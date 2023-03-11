<?php

namespace App\Http\Requests;

use App\Http\Requests\ApiRequest;
use Illuminate\Foundation\Http\FormRequest;

class ProductRequest extends ApiRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\Rule|array|string>
     */
    public function rules(): array
    {
         return $this->isMethod('POST') ? $this->createProduct() : $this->updateProduct() ;
    }

    public function createProduct()
    {
        return [
            'name.en' => 'required',
            'name.ar' => 'required',
            'description.en' => 'required',
            'description.ar' => 'required',
            'price' => 'required',
            'store_id' => 'required'

        ];
    }


    public function updateProduct()
    {
        return [
            'name.en' => 'sometimes|required',
            'name.ar' => 'sometimes|required',
            'description.en' => 'sometimes|required',
            'description.ar' => 'sometimes|required',
            'price' => 'sometimes|required',
        ];
    }
}
