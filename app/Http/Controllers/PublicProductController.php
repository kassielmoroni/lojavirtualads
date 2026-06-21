<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Type;
use Illuminate\Http\Request;

class PublicProductController extends Controller
{
    public function index(Request $request)
    {
        $query = Product::with('type');

        if ($request->filled('type')) {
            $query->where('type_id', $request->type);
        }

        $products = $query->get();
        $types = Type::all();

        return view('welcome', compact('products', 'types'));
    }
    public function show($id)
{
    $product = Product::with('type')->findOrFail($id);

    return view('product-show', compact('product'));
}
}