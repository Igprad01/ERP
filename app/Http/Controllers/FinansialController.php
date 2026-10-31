<?php

namespace App\Http\Controllers;

use App\Enums\Enums\Status;
use App\Enums\Enums\TransaksiType;
use App\Enums\SharedEnum;
use App\Http\Requests\FinansialRequest;
use App\Enums\mekanisme_pembayaran;
use App\Models\Finansial;
use App\Enums\AccountType_financial;
use Illuminate\Http\Request;

class FinansialController extends Controller
{
    public function index(Request $request)
    {
        $finansials = Finansial::view(
            $request->only(['transaksi_type', 'bulan', 'tahun'])
        );

        if ($request->ajax()) {
            return response()->json([
                'success' => true,
                'message' => 'Data berhasil diambil',
                'data' => $finansials,
            ]);
        }

        return view('Transaksi.Keuangan.index', compact('finansials'));
    }

    public function create()
    {
        $data = array_merge(Finansial::formData(), [
            'referenceNumber' => Finansial::generateReferenceNumber(),
            'accountType' => AccountType_financial::cases(),
            'transaksiTypes' => TransaksiType::cases(),
            'periodes' => SharedEnum::cases(),
            'statuses' => Status::status(),
            'mekanisme_pembayaran' => mekanisme_pembayaran::cases(),
        ]);

        return view('Transaksi.Keuangan.tambah', $data);
    }

    public function store(FinansialRequest $request)
    {
        Finansial::add($request->validated());

        return redirect()->route('finansial')
            ->with('success', 'Transaksi berhasil ditambahkan');
    }

    public function edit($id)
    {
        $data = array_merge(
            Finansial::formData(),
            [
                'finansial' => Finansial::findOrFail($id),
                'transaksiTypes' => TransaksiType::cases(),
                'periodes' => SharedEnum::cases(),
                'statuses' => Status::status(),
            ]
        );

        return view('Transaksi.Keuangan.edit', $data);
    }

    public function update(FinansialRequest $request, $id)
    {
        Finansial::edit($request->validated(), $id);

        return redirect()->route('finansial')
            ->with('success', 'Transaksi berhasil diupdate');
    }

    public function destroy($id)
    {
        Finansial::remove($id);

        return redirect()->route('finansial')
            ->with('success', 'Transaksi berhasil dihapus');
    }
}
