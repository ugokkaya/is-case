<?php
namespace App\Repositories\Product;

interface ProductRepositoryInterface{
    public function getAll();
    public function getProductInfo(int $productId);
}