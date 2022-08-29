<?php
namespace App\Repositories\Order;

interface OrderRepositoryInterface{

    public function getAll();

    public function insertOrder($orderInfo, $orderItems);
    
}