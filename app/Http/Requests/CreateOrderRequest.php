<?php

namespace App\Http\Requests;

use App\Rules\Phone;
use Illuminate\Foundation\Http\FormRequest;

class CreateOrderRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return auth()->check();
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, mixed>
     */
    public function rules()
    {
        return [
            'name' => ['required', 'string', 'min:2', 'max:35'],
            'surname' => ['required', 'string', 'min:2', 'max:50'],
            'phone' => ['required', 'string', new Phone, 'max:35'],
            'email' => ['required', 'email'],
            'country' => ['required', 'string', 'min:2', 'max:50'],
            'city' => ['required', 'string', 'min:2', 'max:50'],
            'address' => ['required', 'string', 'min:2', 'max:50'],
        ];
    }

    public function all($keys = null)
    {
        if (empty($keys)) {
            return parent::json()->all();
        }

        return collect(parent::json()->all())->only($keys)->toArray();
    }
}
