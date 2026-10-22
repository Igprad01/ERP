<?php

namespace App\Http\Requests;

use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;

class TripRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'tanggal_mulai' => 'required|date',
            'tanggal_akhir' => 'required|date|after_or_equal:tanggal_mulai',
            'aktivitas' => 'required|string|max:255',
            'lokasi' => 'nullable|string|max:255',
            'category_id' => 'required|exists:table_category,id',
            'orang' => 'nullable|string|max:255',
            'catatan' => 'nullable|string',
            'status' => 'required|string|in:Done,Pending,Batal,Belum Dijalankan',
        ];
    }

    public function messages(): array
    {
        return [
            'tanggal_mulai.required' => 'Tanggal mulai wajib diisi',
            'tanggal_akhir.required' => 'Tanggal akhir wajib diisi',
            'tanggal_akhir.after_or_equal' => 'Tanggal akhir harus setelah tanggal mulai',
            'aktivitas.required' => 'Aktivitas wajib diisi',
            'category_id.required' => 'Kategori wajib diisi',
            'category_id.exists' => 'Kategori tidak valid',
            'status.required' => 'Status wajib diisi',
            'status.in' => 'Status tidak valid',
        ];
    }
}
