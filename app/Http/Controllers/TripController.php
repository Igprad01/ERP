<?php

namespace App\Http\Controllers;

use App\Http\Requests\TripRequest;
use App\Models\Trip;
use Illuminate\Http\Request;

class TripController extends Controller
{
    /**
     * Display a listing of the resource.
     */
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

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('Transaksi.Trip.tambah');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(TripRequest $request)
    {

        $trip = Trip::add($request->validated());
        return response()->json([
            'success' => true,
            'message' => 'Data berhasil ditambahkan',
            'data' => $trip,
        ]);
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        //
    }
}
