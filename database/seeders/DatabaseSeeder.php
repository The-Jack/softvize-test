<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\Product;
use App\Models\Category;
use App\Models\Discount;
use App\Models\CustomerType;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Eloquent\Factories\Sequence;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        CustomerType::create(['type' => 'normal']);
        CustomerType::create(['type' => 'special']);

        User::factory()->create([
            'name' => 'Normal User',
            'customer_type_id' => 1,
            'email' => 'normal@example.com',
            'password' => bcrypt('pass-for-test'),
        ]);

        User::factory()->create([
            'name' => 'Special User',
            'customer_type_id' => 2,
            'email' => 'special@example.com',
            'password' => bcrypt('pass-for-test'),
        ]);

        Category::create(['name' => 'Electronics']);
        Category::create(['name' => 'Clothes']);
        Category::create(['name' => 'Food']);

        Product::factory(10)->state(new Sequence(
                ['category_id' => 1],
                ['category_id' => 2],
                ['category_id' => 3],
            ))->create();


        Discount::create([
            'target_model' => Product::class,
            'target_id' => Product::inRandomOrder()->first()->id,
            'amount' => 16,
        ]);

        Discount::create([
            'target_model' => Category::class,
            'target_id' => Category::inRandomOrder()->first()->id,
            'amount' => 5,
        ]);

        Discount::create([
            'target_model' => CustomerType::class,
            'target_id' => CustomerType::where('type', 'special')->first()->id,
            'amount' => 10,
        ]);
    }
}
