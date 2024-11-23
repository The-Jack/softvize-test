<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class ProductResource extends JsonResource
{
    /**
     * Transform the resource collection into an array.
     *
     * @return array<int|string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'name' => $this->name,
            'category' => $this->category->name,
            'description' => $this->description,
            'base_price' => '£'.number_format($this->price / 100, 2),
            'final_price' => '£'.number_format($this->calculatePrice() / 100, 2),
            'discount' => $this->calculateDiscount().'%',
            'discounts' =>  DiscountResource::collection($this->discounts()),
        ];
    }
}
