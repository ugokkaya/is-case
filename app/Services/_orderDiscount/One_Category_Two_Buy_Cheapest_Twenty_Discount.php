<?php

namespace App\Services\_orderDiscount;

use App\Traits\NumberFormat;
use Illuminate\Support\Facades\DB;

class One_Category_Two_Buy_Cheapest_Twenty_Discount{
    use NumberFormat;

    private const LIMIT = 2;
    private const NAME = "CATEGORY_1_BUY_6_CHEAPEST_PERCENT_20";
    private const CATEGORY = 1;
    private const PERCENT_DISCOUNT = 20;

    public function __construct()
    {

    }

    /**     
     * @param int orderId
     * @param int double newTotal
     * @return array
    */
    public function calculate($orderId, $newTotal)
    {
        $discountResponse  = array(); 
       
 
        $orderInfo = $this->productControl($orderId);
    
        if(!empty($orderInfo)){
            $discount         =  (($orderInfo->first()->quantity * $orderInfo->first()->unitPrice)/100) * self::PERCENT_DISCOUNT;
            $subtotal         =  ($newTotal > 0 ? $newTotal : $orderInfo->first()->orderTotal) - $discount ;
            
            $discountResponse = array(
                                    'discountReason'    => self::NAME,
                                    'discountAmount'    => $this->doubleFormat($discount, 2),
                                    'subtotal'          => $this->doubleFormat($subtotal, 2),
                                );
        }

        return $discountResponse;
    }

    /**     
     * @param int orderId
     * @return object|boolean
    */
    public function productControl($orderId){

        $products = DB::table('orders as o')->select('o.total as orderTotal', 'oi.id as orderItemId', 'oi.quantity', 'oi.unitPrice')
                                            ->join('order_items as oi', 'oi.orderId', '=', 'o.id')
                                            ->join('products as p', 'p.id', '=', 'oi.productId')
                                            ->where('o.id', '=', $orderId)
                                            ->where('p.categoryId', '=', self::CATEGORY)
                                            ->groupBy('oi.id')
                                            ->orderBy('oi.unitPrice')
                                            ->get();

        if(count($products) >= self::LIMIT)
        {
            return $products;
        }else{
            return 0;
        }
    }

}