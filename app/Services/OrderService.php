<?php

namespace App\Services;

use App\Repositories\Order\OrderRepository;
use App\Repositories\Product\ProductRepository;

class OrderService{

    private $orderRepository;

    public function __construct(OrderRepository $orderRepository, ProductRepository $productRepository){
        $this->orderRepository = $orderRepository;
        $this->productRepository = $productRepository;
    }

    /**     
     * @return \Illuminate\Http\Response
    */
    public  function list(){
        return $this->orderRepository->getAll();
    }

    /**     
     * @param \Illuminate\Http\Request  $request
     * @return int $id
     */
    public function store($request){
        $orderItems             = $this->getOrderItems($request);
        $orderInfo              = $this->getOrderInfo($request, $orderItems);

        $insert                 = $this->orderRepository->insertOrder($orderInfo, $orderItems);
        
        return $insert;
    }

    /**     
     * @param int $id
     * @return int $id
     */
    public function delete($id){
        $delete                 = $this->orderRepository->deleteOrder($id);
        
        return $delete;
    }

     /**     
     * @param \Illuminate\Http\Request  $request
     * @return array
     */
    public function getOrderItems($request){
        $orderItems = [];
        foreach($request->items as $item){
            
            $productInfo        = $this->productRepository->getProductInfo($item['productId']);

            $orderItems[]       = array(
                                    'productId'     => $productInfo->id,
                                    'quantity'      => $item['quantity'],
                                    'unitPrice'     => $productInfo->price,
                                    'total'         => $item['quantity'] * $productInfo->price,
                                );
        }

        return $orderItems;
    }

    /**     
     * @param \Illuminate\Http\Request  $request, array $orderItems
     * @return array
     */
    public function getOrderInfo($request, $orderItems){
        $order = array(
                    'customerId' => $request->customerId,
                    'total'      => array_sum(array_column($orderItems, 'total'))
                );

        return $order;
    }

}