<?php

namespace App\Http\Requests\Api;

use App\Enums\UserTypeEnum;
use App\Models\Studio;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class ReserveRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return auth()->user()->user_type == UserTypeEnum::CUSTOMER;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, mixed>
     */
    public function rules()
    {
        return [
            'studio_id' => ['required', Rule::exists((new Studio)->getTable(), 'id')],
        ];
    }
}
