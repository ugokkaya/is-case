<?php

namespace App\Services\_orderDiscount;

use App\Traits\NumberFormat;
use Illuminate\Support\Facades\DB;
use App\Services\_orderDiscount\OrderDiscountInterface;

class Two_Category_Six_Buy_One_Free implements OrderDiscountInterface{
    use NumberFormat;

    private const LIMIT = 6;
    private const NAME = "CATEGORY_2_BUY_6_GET_1";
    private const CATEGORY = 2;

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
            foreach($orderInfo as $item){
                $discount        = ceil(self::LIMIT / $item->quantity);
                $discountAmount  =  $discount * $item->unitPrice;
                $subtotal        =  (($newTotal > 0 ? $newTotal : $item->orderTotal) - $discountAmount);
                
                $discountResponse = array(
                                     'discountReason'    => self::NAME,
                                     'discountAmount'    => $this->doubleFormat($discountAmount, 2),
                                     'subtotal'          => $this->doubleFormat($subtotal, 2),
                                 );
            }
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
                                            ->where('oi.quantity', '>=', self::LIMIT)
                                            ->where('p.categoryId', '=', self::CATEGORY)
                                            ->groupBy('oi.id')
                                            ->get();

        return $products;

    }

}