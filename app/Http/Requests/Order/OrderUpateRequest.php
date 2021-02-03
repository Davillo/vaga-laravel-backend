<?php

namespace App\Http\Requests\Order;

use App\Constants\Order\OrderConstants;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class OrderUpateRequest extends FormRequest
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
            'status' => [
                'required',
                Rule::in([OrderConstants::ORDER_STATUS_OPENED, OrderConstants::ORDER_STATUS_CHECKOUT]),
            ],
        ];
    }
}
