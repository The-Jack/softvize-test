<?php

namespace App\Http\Controllers;

use Inertia\Inertia;
use Inertia\Response;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Http\Resources\ProductResource;
use Illuminate\Http\Resources\Json\ResourceCollection;

class ProductController extends Controller
{
    public function get(Product $product): Response
    {
        return Inertia::render('Product', [
            'product' => (new ProductResource($product))->resolve(),
        ]);
    }

    public function list($ids = null): ResourceCollection
    {
        if ($ids) {
            $products = Product::whereIn('id', $ids)->get();
        } else {
            $products = Product::all();
        }

        return ProductResource::collection($products);
    }
}
