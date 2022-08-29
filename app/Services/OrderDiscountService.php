<?php

namespace App\Services;
use App\Enums\DiscountType;
use App\Models\Orders;
use App\Repositories\Order\OrderRepository;
use App\Traits\NumberFormat;
use Illuminate\Http\Response;


class OrderDiscountService{
    use NumberFormat;
    
    public function __construct(OrderRepository $orderRepository){
        $this->orderRepository = $orderRepository;
    }

    /**     
     * @param  int $orderId
     * @return array
    */
    public function discountCalculate($orderId)
    {
        $orderDiscountResp              = array();
        $orderDiscountResp['orderId']   = $orderId;
        $orderDiscountResp['discounts'] = array();

        $newTotal    = 0;
        foreach(DiscountType::cases() as $item){
            $name        = $item->name;
            $this->$name = new $item->value;
            $discountResponse = $this->$name->calculate($orderId, $newTotal);

            if(!empty($discountResponse)){
              array_push($orderDiscountResp['discounts'], $discountResponse);
              $newTotal = $discountResponse['subtotal'];
            }
        }

        $orderDiscountResp['totalDiscount']     = $this->doubleFormat(array_sum(array_column($orderDiscountResp['discounts'] , 'discountAmount')), 2);
        $orderDiscountResp['discountedTotal']   = $this->doubleFormat($newTotal, 2);

        return $orderDiscountResp;
    }


}