<?php

namespace App\Http\Controllers;

use App\Models\Producto;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Requests\StoreProductoRequest;


class ProductController extends Controller
{
    public function index(Request $request)
    {
        $productos = Producto::orderBy('id', 'desc')->get();
        $quantity = $productos->count();
        $name = null;
        $description = null;
        $category = null;
        $status = null;
        
        if ($request->expectsJson()) {
            return response()->json($productos);
        }

        return view ('productos.list', compact('productos', 'quantity', 'name', 'description', 'category', 'status'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('productos.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreProductoRequest $request)
    {
        $producto = new Producto($request->validated());
        $producto->save();
        
        if ($request->expectsJson()) {
            return response()->json($producto);
        }

        return redirect()->route('productos.index')->with('success', 'Producto creado correctamente');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Producto $producto)
    {
        return view('productos.edit', compact('producto'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(StoreProductoRequest  $request, Producto $producto)
    {
        $producto->update($request->validated());
        
        if ($request->expectsJson()) {
            return response()->json($producto);
        }

        return redirect()->route('productos.index')->with('success', 'Producto actualizado correctamente');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Request $request, Producto $producto)
    {
        $producto->update(['status' => 'Inactivo']);
        
        if ($request->expectsJson()) {
            return response()->json($producto);
        }

        return redirect()->route('productos.index')->with('success', 'Producto inactivado correctamente');
    }

    public function search(Request $request)
    {

        $query = Producto::query();
        $name = $request->name;
        $description = $request->description;
        $category = $request->category;
        $status = $request->status;
        
        if ($request->filled('name')) {
            $query->where(DB::raw('LOWER(name)'), 'LIKE', '%' . strtolower($request->name) . '%');
        }
        
        if ($request->filled('description')) {
            $query->where(DB::raw('LOWER(description)'), 'LIKE', '%' . strtolower($request->description) . '%');
        }

        if ($request->filled('category')) {
            $query->where('category', $request->category);
        }

        if ($request->filled('status')) {
            $query->where('status', $request->status);
        }

        $productos = $query->orderBy('id', 'desc')->get();
        $quantity = $productos->count();
        
        if ($request->expectsJson()) {
            return response()->json($productos);
        }

        return view('productos.list', compact('productos', 'quantity', 'name', 'description', 'category', 'status'));
    }
}
