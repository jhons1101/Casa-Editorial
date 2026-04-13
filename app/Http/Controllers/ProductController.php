<?php

namespace App\Http\Controllers;

use App\Models\Producto;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Requests\StoreProductoRequest;

/**
 * @OA\Info(
 *     title="API Laravel Documentation",
 *     version="1.0.0",
 *     description="Project YouTube API Laravel 11 Documentation",
 *     @OA\Contact(
 *         email="your-email@gmail.com"
 *     )
 * )
*/
class ProductController extends Controller
{
    /**
    * @OA\Get(
    *     path="/api/products",
    *     summary="Get all products",
    *     description="Return a list of products using pagination.",
    *     @OA\Response(
    *         response=200,
    *         description="Products List.",
    *         @OA\JsonContent(
    *             type="object",
    *             @OA\Property(property="data", type="array", @OA\Items(ref="#/components/schemas/Product"))
     *         )
    *     )
    * )
    */
    public function index()
    {
        $productos = Producto::orderBy('id', 'desc')->get();
        $quantity = $productos->count();
        $name = null;
        $description = null;
        $category = null;
        $status = null;
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
        return redirect()->route('productos.index')->with('success', 'Producto actualizado correctamente');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Producto $producto)
    {
        $producto->update(['status' => 'Inactivo']);
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

        $productos = $query->get();
        $quantity = $productos->count();
        return view('productos.list', compact('productos', 'quantity', 'name', 'description', 'category', 'status'));
    }
}
