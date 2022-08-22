<?php

namespace App\Http\Requests;

use App\Rules\Phone;
use Illuminate\Foundation\Http\FormRequest;

class UserAccountRequest extends FormRequest
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
            "name" => ["required", "string", "min:2"],
            "surname" => ["required", "string", "min:3"],
            "email" => ["required", "email"],
            "phone" => ["required", "string", new Phone()],
            "birthdate" => ["required", "date"],
            "balance" => ["required", "numeric", "min:0"]
        ];
    }
}
