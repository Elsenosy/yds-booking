<?php

namespace App\Http\Requests\Api;

use App\Enums\UserTypeEnum;
use App\Models\Reservation;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class CancelReservationRequest extends FormRequest
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
            'reservation_id' => [
                'required',
                'integer',
                Rule::exists((new Reservation)->getTable(), 'id')
                    ->where('customer_id', auth()->id())
            ],
        ];
    }
}
