<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // \App\Models\User::factory(10)->create();
        // Create  admin
        DB::table('admins')->insert([
            'name' => 'Admin',
            'email' => 'admin@example.com',
            'password' => Hash::make('12345678'),
        ]);
        // Create  user
        DB::table('users')->insert([
            'name' => 'John simth',
            'email' => 'johnsimth@example.com',
            'password' => Hash::make('12345678'),
        ]);

        // Create  brand
        DB::table('brand')->insert([
            'title' => 'HP',
            'status' => 1
        ]);

        DB::table('category')->insert([
            'title' => 'Laptop',
            'status' => 1
        ]);

        DB::table('warehouse')->insert([
            'title' => 'Warehouse 1',
            'status' => 1
        ]);

        DB::table('products')->insert([
            'title' => 'HP G3 840',
            'category_id'=> 1,
            'brand_id'=>1,
            'warehouse_id'=>1,
            'quantity'=>25,
            'sku'=>1,
            'price'=>45,
            'status' => 1
        ]);
        // \App\Models\User::factory()->create([
        //     'name' => 'Test User',
        //     'email' => 'test@example.com',
        // ]);
    }
}
