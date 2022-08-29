<?php
namespace App\Services\_orderDiscount;

interface OrderDiscountInterface{

    public function calculate($orderId, $newTotal);
    
}