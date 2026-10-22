<?php

namespace App\Http\Controllers;

use App\Http\Requests\TripRequest;
use App\Models\Trip;
use App\Models\Category;
use App\Enums\Enums\Status;
use Illuminate\Http\Request;

class TripController extends Controller
{
    public function index(Request $request)
    {
        $trip = Trip::view();

        if ($request->ajax()) {
            return response()->json([
                'success' => true,
                'message' => 'Data berhasil diambil',
                'data' => $trip,
            ]);
        }

        return view('Transaksi.Trip.index', compact('trip'));
    }

    public function create()
    {
        $categories = Category::all();
        $statuses = Status::status();
        return view('Transaksi.Trip.tambah', compact('categories', 'statuses'));
    }

    public function store(TripRequest $request)
    {
        $trip = Trip::add($request->validated());
        return redirect()->route('trip')->with('success', 'Trip berhasil ditambahkan');
    }

    public function show($id)
    {
        //
    }

    public function edit($id)
    {
        $trip = Trip::findOrFail($id);
        $categories = Category::all();
        $statuses = Status::status();
        return view('Transaksi.Trip.edit', compact('trip', 'categories', 'statuses'));
    }

    public function update(TripRequest $request, $id)
    {
        $trip = Trip::findOrFail($id);
        $trip->update($request->validated());
        return redirect()->route('trip')->with('success', 'Trip berhasil diupdate');
    }

    public function destroy($id)
    {
        $trip = Trip::findOrFail($id);
        $trip->delete();
        return redirect()->route('trip')->with('success', 'Trip berhasil dihapus');
    }
}
