<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CreateProductRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return auth()->check() && isAdmin(auth()->user());
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, mixed>
     */
    public function rules()
    {
        return [
            'title' => ['required', 'string', 'min:3', 'unique:products'],
            'description' => ['required', 'string', 'min:20'],
            'short_description' => ['required', 'string', 'min:20', 'max:150'],
            'SKU' => ['required', 'string', 'min:2', 'unique:products'],
            'price' => ['required', 'numeric', 'min:2'],
            'discount' => ['required', 'numeric', 'min:0', 'max:99'],
            'in_stock' => ['required', 'numeric', 'min:0'],
            'category' => ['required', 'numeric'],
            'thumbnail' => ['required', 'image:jpeg,png'],
        ];
    }
}
