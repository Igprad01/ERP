<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class FinansialRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        $id = $this->route('id');

        return [
            'reference_number' => 'required|string|max:255|unique:finansials,reference_number' . ($id ? ",$id" : ''),
            'transaksi_date' => 'nullable|date',
            'transaksi_type' => 'required|in:income,expense,transfer',
            'account_id' => 'required|exists:table_account,id',
            'account_to_id' => 'required_if:transaksi_type,transfer|nullable|exists:table_account,id|different:account_id',
            'category_id' => 'required|exists:table_category,id',
            'goal_id' => 'nullable|exists:table_goal,id',
            'debt_id' => 'nullable|exists:table_debt,id',
            'periode' => 'required|in:daily,weekly,monthly,yearly',
            'status' => 'required|in:Done,Pending,Batal,Belum Dijalankan',
            'type' => 'required|in:income,expense',
            'mekanisme_pembayaran' => 'required|string|max:255',
            'total_cost' => 'required|numeric|min:0',
            'catatan' => 'nullable|string',
        ];
    }

    public function messages(): array
    {
        return [
            'reference_number.required' => 'Nomor referensi wajib diisi',
            'reference_number.unique' => 'Nomor referensi sudah digunakan',
            'transaksi_date.date' => 'Format tanggal tidak valid',
            'transaksi_type.required' => 'Tipe transaksi wajib dipilih',
            'transaksi_type.in' => 'Tipe transaksi tidak valid',
            'account_id.required' => 'Akun wajib dipilih',
            'account_id.exists' => 'Akun tidak valid',
            'account_to_id.required_if' => 'Akun tujuan wajib dipilih untuk transfer',
            'account_to_id.exists' => 'Akun tujuan tidak valid',
            'account_to_id.different' => 'Akun tujuan tidak boleh sama dengan akun sumber',
            'category_id.required' => 'Kategori wajib dipilih',
            'category_id.exists' => 'Kategori tidak valid',
            'goal_id.exists' => 'Target tidak valid',
            'debt_id.exists' => 'Utang/piutang tidak valid',
            'periode.required' => 'Periode wajib dipilih',
            'periode.in' => 'Periode tidak valid',
            'status.required' => 'Status wajib dipilih',
            'status.in' => 'Status tidak valid',
            'type.required' => 'Tipe kategori wajib dipilih',
            'type.in' => 'Tipe kategori tidak valid',
            'mekanisme_pembayaran.required' => 'Mekanisme pembayaran wajib diisi',
            'total_cost.required' => 'Nominal wajib diisi',
            'total_cost.numeric' => 'Nominal harus berupa angka',
            'total_cost.min' => 'Nominal tidak boleh negatif',
        ];
    }
}