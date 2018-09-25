<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class EmployeeRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'full_name' => 'required|max:255',
            'br_cpf' => 'required|size:14',
            'email' => 'required|email|max:255',
            'telephone_type' => 'required',
            'telephone' => 'required',
            'zip_code' => 'required|min:8',
            'city' => 'required',
            'state' => 'required',
            'avenue' => 'required',
            'number' => 'required|numeric',
            'neighborhood' => 'required',
            'complement' => 'required',
            'password' => 'required|confirmed|min:8',
        ];
    }
}
