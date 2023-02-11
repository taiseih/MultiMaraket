<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;

use App\Models\Product;
use App\Models\Stock;
use Illuminate\Database\Seeder; 

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // \App\Models\User::factory(10)->create();

        // \App\Models\User::factory()->create([
        //     'name' => 'Test User',
        //     'email' => 'test@example.com',
        // ]);

        $this->call([
            AdminSeeder::class,
            OwnerSeeder::class,
            ShopSeeder::class,
            CategorySeeder::class,
            ImageSeeder::class,
            // ProductSeeder::class,
            // StockSeeder::class,
            UserSeeder::class,
        ]);
        Product::factory(100)->create();
        Stock::factory(100)->create();

    }
}
