<?php

namespace App\Http\Requests;

use App\User;
use Illuminate\Validation\Rule;
use Illuminate\Foundation\Http\FormRequest;

class UpdateUserRequest extends FormRequest
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
            'document' => 'required|numeric|unique:users,document,' . $this->user->id . ',_id',
            'phone' => 'required|numeric|unique:users,phone,' . $this->user->id . ',_id',
            'email' => 'required|string|email|unique:users,email,' . $this->user->id . ',_id',
            'name' => 'required|regex:/^[\pL\s]+$/u',
            'lastname' => 'required|regex:/^[\pL\s]+$/u'
        ];
    }
}
