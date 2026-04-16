<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreProductRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            //
            'name' => 'required|string|max:255',
            'qty' => 'required|integer|min:1',       
            'price' => 'required|numeric|min:0',     
            'user_id' => 'required|exists:users,id',
        ];
    }

    public function messages(): array
    {
        return [
            'name.required' => 'Nama produk wajib diisi!',
            'qty.required' => 'Kuantitas tidak boleh kosong!',
            'qty.min' => 'Kuantitas minimal adalah 1.',
            'price.required' => 'Harga produk wajib diisi!',
            'price.min' => 'Harga tidak boleh minus.',
        ];
    }
}
