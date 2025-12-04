<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class TaskRequest extends FormRequest
{
    public function authorize()
    {
        return true; // untuk sekarang izinkan. Di aplikasi nyata, cek auth.
    }

    public function rules()
    {
        return [
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
            'due_at' => 'nullable|date|after_or_equal:today',
            'is_completed' => 'sometimes|boolean',
        ];
    }

    public function messages()
    {
        return [
            'title.required' => 'Judul tugas wajib diisi.',
            'due_at.after_or_equal' => 'Tanggal jatuh tempo harus tanggal hari ini atau setelahnya.',
        ];
    }
}
