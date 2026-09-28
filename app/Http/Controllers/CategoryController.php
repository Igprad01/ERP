<?php

namespace App\Http\Controllers;

use App\Http\Requests\categoryRequest;
use Illuminate\Http\Request;
use App\Models\Category;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $viewkategori = Category::view();
        return view('Master.Category.index', compact('viewkategori'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('Master.Category.Tambah');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(categoryRequest $request)
    {
        Category::add($request->validated());
        return redirect()->route('category')->with('success', 'Category created successfully');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $edit = Category::find($id);
        return view('Master.Category.edit', compact('edit'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(categoryRequest $request, string $id)
    {
        Category::edit($request->validated(), $id);
        return redirect()->route('category')->with('success', 'Category updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $kategori = Category::find($id);
        $kategori->delete();
        return redirect()->route('category')->with('success', 'Category deleted successfully');
    }
}
