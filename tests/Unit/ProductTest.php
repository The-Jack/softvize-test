<?php

namespace Tests\Unit;

use Tests\TestCase;
use App\Models\User;
use App\Models\Product;
use App\Models\Category;
use App\Models\Discount;
use App\Models\CustomerType;

class ProductTest extends TestCase
{
    public function test_price_is_calculated(): void
    {
        //setup
        $fakeProduct1 = $this->getMockBuilder(Product::class)
        ->onlyMethods(['calculateDiscount'])
        ->getMock();
        $fakeProduct1->method('calculateDiscount')->willReturn(0);
        $fakeProduct1->price = 100;

        $fakeProduct2 = $this->getMockBuilder(Product::class)
            ->onlyMethods(['calculateDiscount'])
            ->getMock();
        $fakeProduct2->method('calculateDiscount')->willReturn(50);
        $fakeProduct2->price = 100;

        $expected = 100;
        $this->assertEquals($expected, $fakeProduct1->calculatePrice());

        $expected = 50;
        $this->assertEquals($expected, $fakeProduct2->calculatePrice());

    }

    public function test_product_discount_is_calculated(): void
    {
        //setup
        $fakeCustomerType = CustomerType::factory()->create(['type' => 'test']);
        $this->actingAs($fakeUser = User::factory()->create(['customer_type_id' => $fakeCustomerType->id]));
        $fakeCategory = Category::create(['name' => 'Test Category']);
        $fakeProduct = Product::factory()->create(['category_id' => $fakeCategory->id]);
        $fakeDiscount = Discount::factory()->create([
            'target_model' => Product::class,
            'target_id' =>  $fakeProduct->id,
            'amount'    => 77,
        ]);

        //the test.
        $expected = 77;
        $this->assertEquals($expected, $fakeProduct->calculateDiscount());

        //should be on its own test database that is seeded fresh before running tests instead of this.
        $fakeCustomerType->delete();
        $fakeCategory->delete();
        $fakeProduct->delete();
        $fakeUser->delete();
        $fakeDiscount->delete();
    }

    public function test_category_discount_is_calculated(): void
    {
        //setup
        $fakeCustomerType = CustomerType::factory()->create(['type' => 'test']);
        $this->actingAs($fakeUser = User::factory()->create(['customer_type_id' => $fakeCustomerType->id]));
        $fakeCategory = Category::create(['name' => 'Test Category']);
        $fakeProduct = Product::factory()->create(['category_id' => $fakeCategory->id]);
        $fakeDiscount = Discount::factory()->create([
            'target_model' => Category::class,
            'target_id' =>  $fakeCategory->id,
            'amount'    => 43,
        ]);

        //the test.
        $expected = 43;
        $this->assertEquals($expected, $fakeProduct->calculateDiscount());

        //should be on its own test database that is seeded fresh before running tests instead of this.
        $fakeCustomerType->delete();
        $fakeCategory->delete();
        $fakeProduct->delete();
        $fakeUser->delete();
        $fakeDiscount->delete();
    }

    public function test_customer_type_discount_is_calculated(): void
    {
        //setup
        $fakeCustomerType = CustomerType::factory()->create(['type' => 'test']);
        $this->actingAs($fakeUser = User::factory()->create(['customer_type_id' => $fakeCustomerType->id]));
        $fakeCategory = Category::create(['name' => 'Test Category']);
        $fakeProduct = Product::factory()->create(['category_id' => $fakeCategory->id]);
        $fakeDiscount = Discount::factory()->create([
            'target_model' => CustomerType::class,
            'target_id' =>  $fakeCustomerType->id,
            'amount'    => 99,
        ]);

        //the test.
        $expected = 99;
        $this->assertEquals($expected, $fakeProduct->calculateDiscount());

        //should be on its own test database that is seeded fresh before running tests instead of this.
        $fakeCustomerType->delete();
        $fakeCategory->delete();
        $fakeProduct->delete();
        $fakeUser->delete();
        $fakeDiscount->delete();
    }

    public function test_multiple_discounts_is_calculated(): void
    {
        //setup
        $fakeCustomerType = CustomerType::factory()->create(['type' => 'test']);
        $this->actingAs($fakeUser = User::factory()->create(['customer_type_id' => $fakeCustomerType->id]));
        $fakeCategory = Category::create(['name' => 'Test Category']);
        $fakeProduct = Product::factory()->create(['category_id' => $fakeCategory->id]);
        $fakeDiscount1 = Discount::factory()->create([
            'target_model' => CustomerType::class,
            'target_id' =>  $fakeCustomerType->id,
            'amount'    => 22,
        ]);
        $fakeDiscount2 = Discount::factory()->create([
            'target_model' => Product::class,
            'target_id' =>  $fakeProduct->id,
            'amount'    => 11,
        ]);
        $fakeDiscount3 = Discount::factory()->create([
            'target_model' => Category::class,
            'target_id' =>  $fakeCategory->id,
            'amount'    => 5,
        ]);

        //the test.
        $expected = 38;
        $this->assertEquals($expected, $fakeProduct->calculateDiscount());

        //should be on its own test database that is seeded fresh before running tests instead of this.
        $fakeCustomerType->delete();
        $fakeCategory->delete();
        $fakeProduct->delete();
        $fakeUser->delete();
        $fakeDiscount1->delete();
        $fakeDiscount2->delete();
        $fakeDiscount3->delete();
    }
}
