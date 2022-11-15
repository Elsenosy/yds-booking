<?php

namespace App\Http\Requests\Api;

use App\Enums\UserTypeEnum;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class StoreStudioRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return auth()->user()->user_type == UserTypeEnum::STUDIO_OWNER;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, mixed>
     */
    public function rules()
    {
        return [
            'name'                  => ['required', 'string', 'min:3', 'max:255'],
            'max_day_reservations'  => ['required', 'integer', 'min:0', 'max:10000'],
            'employees'             => ['required', 'array', 'min:1', 'max:10'],
            'employees.*'           => ['required', 'integer', Rule::exists('users', 'id')->where('user_type', UserTypeEnum::EMPLOYEE)],
        ];
    }
}
