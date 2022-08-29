<?php
namespace App\Repositories\Product;

use App\Repositories\Product\ProductRepositoryInterface;
use App\Models\Products;

class ProductRepository implements ProductRepositoryInterface
{
    public function getAll(){
        return Products::all();
    }

    public function getProductInfo($productId){
        return Products::select('id', 'name', 'categoryId', 'price', 'stock')
                        ->where('id', '=', $productId)
                        ->first();
    }
}