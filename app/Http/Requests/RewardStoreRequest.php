<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class RewardStoreRequest extends FormRequest
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
            'thumbnail' => ['required', 'image', 'mimes:jpg,jpeg,png', 'max:2048'],
            'name' => ['required', 'string', 'min:3', 'max:255'],
            'point_cost' => ['required', 'integer', 'min:1'],
            'stock' => ['required', 'integer'],
            'is_active' => ['required', 'boolean'],
        ];
    }

    public function attributes()
    {
        return [
            'thumbnail' => 'Gambar Hadiah',
            'name' => 'Nama Hadiah',
            'point_cost' => 'Harga Poin',
            'stock' => 'Stok',
            'is_active' => 'Status',
        ];
    }
}
