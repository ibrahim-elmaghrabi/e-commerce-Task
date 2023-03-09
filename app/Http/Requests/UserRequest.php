<?php

namespace App\Http\Requests;

use App\Http\Requests\ApiRequest;
use Illuminate\Foundation\Http\FormRequest;

class UserRequest extends ApiRequest
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
        return $this->isMethod('POST') ? $this->createUser() : $this->updateUser() ;
    }

    public function createUser()
    {
        return [
            'name' => 'required',
            'email' => 'required|email',
            'password' => 'required|confirmed',
        ];
    }

    public function updateUser()
    {
        return [
            'name' => 'sometimes|required',
            'email' => 'required|email|unique:users,'.$this->id,
            'password' => 'sometimes|required|confirmed',
        ];
    }
}
