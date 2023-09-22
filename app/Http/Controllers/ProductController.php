<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Models\Product;

class ProductController extends Controller
{
    public function index()
    {
        $products = Product::all(['link', 'judul']);
        return response()->json(['products' => $products]);
    }

    public function show($id)
    {
        $product = Product::find($id);

        if (!$product) {
            return response()->json(['message' => 'Produk tidak ditemukan'], 404);
        }

        return response()->json(['product' => $product]);
    }

    public function store(Request $request)
    {
        $this->validate($request, [
            'judul' => 'required',
            'link' => 'required|unique:products',
        ]);

        $product = new Product();
        $product->judul = $request->input('judul');
        $product->link = $request->input('link');

        $product->save();

        return response()->json(['message' => 'Produk berhasil ditambahkan']);
    }

    public function update(Request $request, $id)
    {
        $this->validate($request, [
            'judul' => 'required',
            'link' => 'required|unique:products,link,' . $id,
        ]);

        $product = Product::find($id);

        if (!$product) {
            return response()->json(['message' => 'Produk tidak ditemukan'], 404);
        }

        $product->judul = $request->input('judul');
        $product->link = $request->input('link');

        $product->save();

        return response()->json(['message' => 'Produk berhasil diperbarui']);
    }

    public function destroy($id)
    {
        $product = Product::find($id);

        if (!$product) {
            return response()->json(['message' => 'Produk tidak ditemukan'], 404);
        }

        $product->delete();

        return response()->json(['message' => 'Produk berhasil dihapus']);
    }
}
