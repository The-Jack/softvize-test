<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Discount extends Model
{
    use HasFactory;

    public function target(): ?string
    {
        switch ($this->target_model) {
            case ('App\Models\Category'):
                return Category::find($this->target_id)->name;
                break;
            case ('App\Models\Product'):
                return Product::find($this->target_id)->name;
                break;
            case ('App\Models\CustomerType'):
                return CustomerType::find($this->target_id)->type;
                break;
        }
    }
}
