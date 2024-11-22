<?php

namespace App\Http\Controllers;

use App\Models\Discount;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Http\Resources\DiscountResource;
use Illuminate\Http\Resources\Json\ResourceCollection;

class DiscountController extends Controller
{
    public function list($ids = null): ResourceCollection
    {
        if ($ids) {
            $discounts = Discount::whereIn('id', $ids)->get();
        } else {
            $discounts = Discount::all();
        }

        return DiscountResource::collection($discounts);
    }
}
