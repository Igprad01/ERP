<?php

namespace App\Http\Controllers;

use App\Http\Requests\TripRequest;
use App\Models\Trip;
use App\Models\Category;
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

        $status = Trip::getstatus();

        return view('Transaksi.Trip.tambah', compact('categories', 'status'));
    }

    public function store(TripRequest $request)
    {
        Trip::add($request->validated());
        return redirect()->route('trip')->with('success', 'Trip berhasil ditambahkan');
    }

    public function show($id) {}

    public function edit($id)
    {
        $trip = Trip::findOrFail($id);
        $categories = Category::all();
        return view('Transaksi.Trip.edit', compact('trip', 'categories'));
    }

    public function update(TripRequest $request, $id)
    {
        $trip = Trip::findOrFail($id);
        $trip->update($request->validated());
        return redirect()->route('trip')->with('success', 'Trip berhasil diupdate');
    }

    public function destroy($id)
    {
        $delete = Trip::remove($id);
        if ($delete) {
            return redirect()->route('trip')->with('success', 'Trip berhasil dihapus');
        }
        return redirect()->route('trip')->with('error', 'Trip gagal dihapus');
    }
}
