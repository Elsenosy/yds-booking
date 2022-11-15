<?php

namespace App\Http\Requests\Api;

use App\Enums\UserTypeEnum;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UserRegisterRequest extends FormRequest
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
     * @return array<string, mixed>
     */
    public function rules()
    {
        return [
            'name'      => 'required|string|min:3|max:255',
            'email'     => ['required', 'email', 'max:255', Rule::unique('users')],
            'password'  => 'required|confirmed|min:6|max:255',
            'user_type' => ['required', 'string', Rule::in(UserTypeEnum::values())],
        ];
    }
}
