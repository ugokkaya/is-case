<?php
namespace App\Repositories\Order;

use App\Models\Customers;
use App\Models\OrderItems;
use App\Repositories\Order\OrderRepositoryInterface;
use App\Models\Orders;
use Illuminate\Support\Facades\DB;


class OrderRepository implements OrderRepositoryInterface
{
    public function getAll(){
        return Orders::with('order_items')->get();
    }

    public function insertOrder($orderInfo, $orderItems){
        DB::beginTransaction();

        try {
            $order = Orders::create($orderInfo);
            $order->order_items()->createMany($orderItems);

            foreach($orderItems as $item){
                DB::table('products')->where('id', '=', $item['productId'])->decrement('stock', $item['quantity']);
            }

            DB::commit();           
        } catch (\Exception $ex) {
            DB::rollback();
            return response()->json(['status' => false, 'error' => $ex->getMessage()], 500);
        }

        return $order->id;
    }

    public function deleteOrder($id){
        DB::beginTransaction();

        try {
            $orderItems = OrderItems::where('orderId', '=', $id)->get();
            if($orderItems->count() > 0){
                foreach($orderItems as $item){
                    DB::table('products')->where('id', '=', $item['productId'])->increment('stock', $item['quantity']);
                }
                OrderItems::where('orderId', '=', $id)->delete();
                Orders::where('id', '=', $id)->delete();
            
                DB::commit();
            }else{
                return 0;
            }
           
        } catch (\Exception $ex) {
            DB::rollback();
            return response()->json(['status' => false, 'error' => $ex->getMessage()], 500);
        }

        return $id;
    }

    public function getOrder($orderId){
        return Orders::with('order_items')->where('id', '=', $orderId)->first();
    }
}