<?php

namespace App\Http\Requests;

use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;

class TripRequest extends FormRequest
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
     * @return array<string, ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'tanggal_mulai' => 'required',
            'tanggal_akhir' => 'required',
            'aktivitas' => 'required',
            'lokasi' => 'required',
            'category_id' => 'required',
            'orang' => 'required',
            'catatan' => 'required',
            'status' => 'required',
        ];
    }

    public function messages(): array
    {
        return [
            'tanggal_mulai.required' => 'Tanggal mulai wajib diisi',
            'tanggal_akhir.required' => 'Tanggal akhir wajib diisi',
            'aktivitas.required' => 'Aktivitas wajib diisi',
            'lokasi.required' => 'Lokasi wajib diisi',
            'category_id.required' => 'Kategori wajib diisi',
            'orang.required' => 'Orang wajib diisi',
            'catatan.required' => 'Catatan wajib diisi',
            'status.required' => 'Status wajib diisi',
        ];
    }
}
