<?php

namespace App\Services\_orderDiscount;

use App\Repositories\Order\OrderRepository;
use App\Traits\NumberFormat;

class Thousand_Buy_Ten_Discount{
    use NumberFormat;

    private const LIMIT = 1000;
    private const NAME = "10_PERCENT_OVER_1000";
    private const PERCENT_DISCOUNT = 10;

    public function __construct(){
        $this->orderRepository = new OrderRepository();
    }

    /**     
     * @param int orderId
     * @param int double newTotal
     * @return array
    */
    public function calculate($orderId, $newTotal)
    {
        $discountResponse  = array(); 
        $orderInfo = $this->orderRepository->getOrder($orderId);
        if($orderInfo->total > self::LIMIT)
        {
           $discountAmount  = ($orderInfo->total/100) * self::PERCENT_DISCOUNT;
           $subtotal        = ($newTotal > 0 ? $newTotal : $orderInfo->total) - $discountAmount ;
           
           $discountResponse = array(
                                'discountReason'    => self::NAME,
                                'discountAmount'    => $this->doubleFormat($discountAmount, 2),
                                'subtotal'          => $this->doubleFormat($subtotal, 2),
                            );
        }

        return $discountResponse;
    }

}