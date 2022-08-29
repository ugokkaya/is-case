<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Products;
use File;

class ProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Products::truncate();
  
        $json = File::get("database/data/products.json");
        $products = json_decode($json);

        foreach ($products as $key => $value) {
          
            Products::create([
                "id"        => $value->id,
                "name"      => $value->name,
                "categoryId"=> $value->category,
                "price"     => $value->price,
                "stock"     => $value->stock
            ]);
        }
    }
}
