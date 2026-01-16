<?php

namespace App\Http\Requests;

use App\Models\User;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rules;

class UserStoreRequest extends FormRequest
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
            'avatar' => ['nullable', 'image', 'mimes:jpg,jpeg,png', 'max:2048'],

            'nik' => ['required', 'string', 'max:16', 'unique:' . User::class],
            'name' => ['required', 'string', 'min:3', 'max:255'],
            'email' => ['required', 'string', 'lowercase', 'email', 'max:255', 'unique:' . User::class],
            'phone' => ['required', 'string', 'min:10', 'max:13', 'unique:' . User::class],

            'date_of_birth' => ['nullable', 'date'],
            'address' => ['nullable', 'string', 'min:3', 'max:255'],
            'type_of_work' => ['nullable', 'string', 'max:255'],

            'password' => ['required', 'confirmed', Rules\Password::defaults()],
        ];
    }

    public function attributes()
    {
        return [
            'avatar' => 'Foto Profil',
            'nik' => 'NIK',
            'name' => 'Nama Lengkap',
            'email' => 'Email',
            'phone' => 'Nomor Telepon',

            'date_of_birth' => 'Tanggal Lahir',
            'address' => 'Alamat',
            'type_of_work' => 'Pekerjaan',

            'password' => 'Kata Sandi',
        ];
    }
}
