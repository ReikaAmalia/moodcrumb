<?php

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;

class StoreMoodRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'name' => [
                'required',
                'string',
                'max:100',
                'unique:moods,name',
            ],

            'description' => [
                'nullable',
                'string',
            ],

            'icon' => [
                'nullable',
                'string',
                'max:255',
            ],
        ];
    }

    public function messages(): array
    {
        return [
            'name.required' => 'Nama mood wajib diisi.',
            'name.string' => 'Nama mood harus berupa teks.',
            'name.max' => 'Nama mood maksimal 100 karakter.',
            'name.unique' => 'Nama mood sudah digunakan.',

            'description.string' => 'Deskripsi harus berupa teks.',

            'icon.string' => 'Icon harus berupa teks.',
            'icon.max' => 'Icon maksimal 255 karakter.',
        ];
    }
}