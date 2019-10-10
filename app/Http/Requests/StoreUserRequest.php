<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreUserRequest extends FormRequest
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
            'document' => 'required|numeric|unique:users,document',
            'phone' => 'required|numeric|unique:users,phone',
            'email' => 'required|email|unique:users,email',
            'name' => 'required|alpha_num',
            'lastname' => 'required|alpha_num'
        ];
    }
}

