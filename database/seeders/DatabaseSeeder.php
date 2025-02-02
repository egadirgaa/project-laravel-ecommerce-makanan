<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\Product;
use App\Models\Category;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // Membuat user admin dan customer
        User::create([
            'name' => 'admin',
            'email' => 'admin@gmail.com',
            'password' => Hash::make('1'),
            'phone' => '089503828151',
            'address' => 'jambi',
            'role' => 'seller'
        ]);

        User::create([
            'name' => 'customer',
            'email' => 'customer@gmail.com',
            'password' => Hash::make('1'),
            'phone' => '089503828152',
            'address' => 'jambi',
        ]);

        // Menambahkan kategori langsung ke database
        Category::create([
            'name' => 'makanan',
            'description' => 'Beragam hidangan lezat yang siap memanjakan selera Anda, mulai dari makanan tradisional hingga modern, dengan kualitas terbaik dan bahan-bahan segar.',
        ]);

        // Menambahkan produk ke database
        Product::create([
            'name' => 'Makanan Enak',
            'description' => 'Ini Enak',
            'price' => 50000,
            'seller_id' => 1, 
            'stock' => 5, 
            'image' => 'products/plate1.png',
            'category_id' => 1,
        ]);

        Product::create([
            'name' => 'Makanan Enak 2',
            'description' => 'Ini cukup enak',
            'price' => 30000,
            'seller_id' => 1, 
            'stock' => 3, 
            'image' => 'products/plate2.png',
            'category_id' => 1,
        ]);

        Product::create([
            'name' => 'Makanan Enak 3',
            'description' => 'Ini Enak',
            'price' => 20000,
            'seller_id' => 1, 
            'stock' => 7, 
            'image' => 'products/plate3.png',
            'category_id' => 1,
        ]);
    }
}
