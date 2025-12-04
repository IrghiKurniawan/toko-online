<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Symfony\Component\HttpFoundation\Request;

class ProductController extends Controller
{
    public function index(Request $request)
    {
        $search = $request->search ?? '';

        $products = Product::when($search, function ($query) use ($search) {
            $query->where(function ($q) use ($search) {
                $q->where('name', 'like', "%$search%")
                    ->orWhere('description', 'like', "%$search%");
            });
        })
            ->latest()->paginate(10);

        return view('products.index', compact('products', 'search'));
    }
}
