<?php

namespace App\Models;

use App\Models\Category;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Product extends Model
{
    use HasFactory;

    public function category(): BelongsTo
    {
        return $this->BelongsTo(Category::class);
    }

    public function discounts()
    {
        $discounts = Discount::where('target_id', $this->id)
            ->where('target_model', Product::class)
            ->orWhere('target_model', Category::class)
            ->where('target_id', $this->category_id)
            ->orwhere('target_model', CustomerType::class)
            ->where('target_id', auth()->user()->customer_type_id)
            ->get();

        return $discounts;
    }

    public function calculatePrice(): Int
    {
        $amountToDiscount = $this->calculateDiscount();
        return $this->price * (1-$amountToDiscount/100);
    }

    public function calculateDiscount(): int
    {
        $totalDiscount = 0;

        $productDiscounts = Discount::where('target_id', $this->id)
            ->where('target_model', Product::class)
            ->first();
        if ($productDiscounts) {
            $totalDiscount += $productDiscounts->amount;
        };

        $categoryDiscounts = Discount::where('target_model', Category::class)
            ->where('target_id', $this->category_id)
            ->first();
        if ($categoryDiscounts) {
            $totalDiscount += $categoryDiscounts->amount;
        };

        $customerDiscounts = Discount::where('target_model', CustomerType::class)
            ->where('target_id', auth()->user()->customer_type_id)
            ->first();
        if ($customerDiscounts) {
            $totalDiscount += $customerDiscounts->amount;
        };
        return $totalDiscount;
    }
}
