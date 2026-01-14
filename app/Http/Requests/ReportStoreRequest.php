<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ReportStoreRequest extends FormRequest
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
            'category_id' => ['required', 'integer'],
            'title' => ['required', 'string', 'min:3', 'max:255'],
            'description' => ['required', 'string', 'min:50', 'max:65535'],
            'location' => ['required', 'string', 'min:3', 'max:255'],
            'latitude' => ['required', 'numeric'],
            'longitude' => ['required', 'numeric'],

            // Validasi untuk array 'files'
            'files' => ['required', 'array', 'min:1', 'max:3'],

            // Validasi untuk SETIAP file di dalam array 'files'
            'files.*' => [
                'file',
                'mimetypes:image/png,image/jpeg,image/jpg,video/mp4,video/quicktime',
                'max:20480' // Maksimal 20MB per file
            ],
        ];
    }

    public function attributes()
    {
        return [
            'title' => 'Judul Laporan',
            'description' => 'Deskripsi Laporan',
            'location' => 'Lokasi Laporan',
            'files' => 'Foto/Video',
        ];
    }
}
