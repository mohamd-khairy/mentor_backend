<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Http\Exceptions\HttpResponseException;
use Illuminate\Support\Facades\Request;

class AdminGeneralValidation extends FormRequest
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
        switch (Request::segment(1)) {
            case 'lookup_type':
                return [
                    'name_en' => 'required',
                    'name_ar' => 'required',
                    'key' => 'required'
                ];
                break;

            case 'user':
                return [
                    'name_en' => 'required',
                    'name_ar' => 'required',
                    'role_id' => 'required',
                    'email' => 'required',
                    'password' => 'required',
                    'mobile' => 'required',
                    'image' => 'required',
                ];
                break;
            default:
                return [];
                break;
        }
    }
}
