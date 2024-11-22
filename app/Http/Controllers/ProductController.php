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

    /* public function store(Request $request)
    {
        $validatedForm = $request->validate([
            'title' => 'required|max:255',
            'description' => 'required',
        ]);

        Task::create([
            'title' => $validatedForm['title'],
            'description' => $validatedForm['description'],
            'owner' => Auth::id(),
        ]);
    } */

    public function update(Request $request)
    {
        $validatedForm = $request->validate([
            'id' => 'required|integer',
        ]);

        $task = Task::where('id', $validatedForm['id'])
            ->where('owner', Auth::id())
            ->first();

        if ($task) {
            $task->complete = true;
            $task->save();
        }  else {
            return json_encode([
                'status' => 'error',
                'message' => 'not authorised',
            ]);
        }
    }

    /* public function delete(Request $request)
    {
        $validatedForm = $request->validate([
            'id' => 'required|integer',
        ]);

        $task = Task::where('id', $validatedForm['id'])
            ->where('owner', Auth::id())
            ->first();

        if ($task) {
            $task->delete();
        } else {
            return json_encode([
                'status' => 'error',
                'message' => 'not authorised',
            ]);
        }
    } */
}
