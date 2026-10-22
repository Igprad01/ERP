<?php

namespace App\Http\Controllers;

use App\Http\Requests\FinansialRequest;
use App\Models\Finansial;
use App\Models\Category;
use App\Models\Account;
use App\Models\Goal;
use App\Models\Debt;
use App\Models\Trip;
use App\Enums\TransaksiType;
use App\Enums\SharedEnum;
use App\Enums\Enums\Status;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class FinansialController extends Controller
{
    public function index(Request $request)
    {
        $query = Finansial::with(['category', 'account', 'accountTo', 'goal', 'debt'])
            ->latest('transaksi_date')
            ->latest();

        if ($request->filled('transaksi_type')) {
            $query->where('transaksi_type', $request->transaksi_type);
        }

        if ($request->filled('bulan')) {
            $query->whereMonth('transaksi_date', $request->bulan)
                ->whereYear('transaksi_date', $request->filled('tahun') ? $request->tahun : now()->year);
        }

        $finansials = $query->paginate(10)->withQueryString();

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
        $categories = Category::where('is_active', true)->get();
        $accounts = Account::where('is_active', true)->get();
        $goals = Goal::where('status', 'active')->get();
        $debts = Debt::where('status', 'active')->get();
        $trips = Trip::all();

        $transaksiTypes = TransaksiType::cases();
        $periodes = SharedEnum::cases();
        $statuses = Status::status();

        return view('Transaksi.Keuangan.tambah', compact(
            'categories',
            'accounts',
            'goals',
            'debts',
            'trips',
            'transaksiTypes',
            'periodes',
            'statuses'
        ));
    }

    public function store(FinansialRequest $request)
    {
        $data = $request->validated();

        DB::transaction(function () use ($data) {
            $finansial = Finansial::create($data);
            $this->syncSaldo($finansial, 1);
        });

        return redirect()->route('finansial')
            ->with('success', 'Transaksi berhasil ditambahkan');
    }

    public function edit($id)
    {
        $finansial = Finansial::findOrFail($id);

        $categories = Category::where('is_active', true)->get();
        $accounts = Account::where('is_active', true)->get();
        $goals = Goal::where('status', 'active')->get();
        $debts = Debt::where('status', 'active')->get();
        $trips = Trip::all();

        $transaksiTypes = TransaksiType::cases();
        $periodes = SharedEnum::cases();
        $statuses = Status::status();

        return view('Transaksi.Keuangan.edit', compact(
            'finansial',
            'categories',
            'accounts',
            'goals',
            'debts',
            'trips',
            'transaksiTypes',
            'periodes',
            'statuses'
        ));
    }

    public function update(FinansialRequest $request, $id)
    {
        $finansial = Finansial::findOrFail($id);

        $data = $request->validated();

        DB::transaction(function () use ($finansial, $data) {
            $this->syncSaldo($finansial, -1);
            $finansial->update($data);
            $this->syncSaldo($finansial, 1);
        });

        return redirect()->route('finansial')
            ->with('success', 'Transaksi berhasil diupdate');
    }

    public function destroy($id)
    {
        $finansial = Finansial::findOrFail($id);

        DB::transaction(function () use ($finansial) {
            $this->syncSaldo($finansial, -1);
            $finansial->delete();
        });

        return redirect()->route('finansial')
            ->with('success', 'Transaksi berhasil dihapus');
    }

    private function syncSaldo(Finansial $finansial, int $sign): void
    {
        if (!$finansial->account_id) {
            return;
        }

        $account = Account::find($finansial->account_id);
        if (!$account) {
            return;
        }

        $amount = $finansial->total_cost * $sign;

        switch ($finansial->transaksi_type) {
            case 'income':
                $account->increment('saldo', $amount);
                break;
            case 'expense':
                $account->decrement('saldo', $amount);
                break;
            case 'transfer':
                $account->decrement('saldo', $amount);
                if ($finansial->account_to_id) {
                    $targetAccount = Account::find($finansial->account_to_id);
                    if ($targetAccount) {
                        $targetAccount->increment('saldo', $amount);
                    }
                }
                break;
        }
    }
}
