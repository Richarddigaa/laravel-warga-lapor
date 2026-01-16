<?php

namespace App\Http\Requests;

use App\Models\User;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UserUpdateRequest extends FormRequest
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
        $citizen = $this->route('citizen');

        if ($citizen) {
            // KASUS ADMIN:
            // Jika route parameter 'citizen' ada, gunakan ID dari situ.
            // Kita cek apakah $citizen itu object (Model Binding) atau sekedar ID string
            $userId = $citizen instanceof \App\Models\User ? $citizen->id : $citizen;
        } else {
            // KASUS USER SENDIRI:
            // Jika tidak ada parameter 'citizen', berarti user sedang edit profil sendiri.
            // Ambil ID dari user yang sedang login.
            $userId = $this->user()->id;
        }

        return [
            'avatar' => ['nullable', 'image', 'mimes:jpg,jpeg,png', 'max:2048'],

            'nik' => [
                'required',
                'string',
                'max:16',
                Rule::unique(User::class)->ignore($userId)
            ],
            'name' => ['required', 'string', 'min:3', 'max:255'],
            'email' => [
                'required',
                'string',
                'lowercase',
                'email',
                'max:255',
                Rule::unique(User::class)->ignore($userId)
            ],
            'phone' => [
                'required',
                'string',
                'min:10',
                'max:13',
                Rule::unique(User::class)->ignore($userId)
            ],

            'date_of_birth' => ['nullable', 'date'],
            'address' => ['nullable', 'string', 'min:3', 'max:255'],
            'type_of_work' => ['nullable', 'string', 'max:255'],
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
        ];
    }
}
