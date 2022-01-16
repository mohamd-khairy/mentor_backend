<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Http\Exceptions\HttpResponseException;

class ApiGeneralValidation extends FormRequest
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
        switch ($this->route()->getActionMethod()) {
            case 'login':
                return [
                    'key' => 'required',
                    'password' => 'required'
                ];
                break;

            case 'register':
                return [
                    'name' => 'required|string|min:3|max:100',
                    'email' => 'required|email|unique:users,email',
                    'mobile' => 'required|numeric|min:10|unique:users,mobile',
                    'password' => 'required|min:6|max:32',
                    'type' => 'in:user,mentor'
                ];
                break;
            default:
                return [];
                break;
        }
    }


    public function failedValidation(Validator $validator)
    {
        throw new HttpResponseException(response()->json(['status' => false, 'message' => $validator->errors()->first()], 200));
    }
}
