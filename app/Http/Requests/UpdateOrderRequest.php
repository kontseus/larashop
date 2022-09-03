<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateOrderRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return isAdmin(auth()->user());
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'status_id' => ['required', 'numeric'],
            'name' => ['required', 'string', 'min:2'],
            'surname' => ['required', 'string', 'min:2'],
            'email' => ['required', 'email', 'min:2'],
            'phone' => ['required', 'string', 'min:2'],
            'country' => ['required', 'string', 'min:2'],
            'city' => ['required', 'string', 'min:2'],
            'address' => ['required', 'string', 'min:2'],
        ];
    }
}
