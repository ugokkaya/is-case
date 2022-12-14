<?php

namespace App\Services;

use App\Repositories\Product\ProductRepository;


class ProductService{

    private $productRepository;

    public function __construct(ProductRepository $productRepository){
        $this->productRepository = $productRepository;
    }

    /**     
     * @return \Illuminate\Http\Response
    */
    public  function list(){
        return $this->productRepository->getAll();
    }

}