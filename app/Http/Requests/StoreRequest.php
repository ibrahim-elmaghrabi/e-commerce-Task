<?php

namespace App\Http\Requests;

use App\Http\Requests\ApiRequest;
use Illuminate\Foundation\Http\FormRequest;

class StoreRequest extends ApiRequest
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
       return $this->isMethod('POST') ? $this->createStore() : $this->updateStore() ;
    }

    public function createStore()
    {
        return [
            'name'=> 'required|string',
            'vat_included'=> 'required|boolean',
            'vat_percentage'=> 'between:0,99.99',
            'shipping_cost' => 'between:0,99.99',
        ];
    }

     public function updateStore()
    {
        return [
            'name'=> 'sometimes|required|string',
            'vat_included'=> 'sometimes|required|boolean',
            'vat_percentage'=> 'between:0,99.99',
            'shipping_cost' => 'between:0,99.99',
        ];
    }
}
