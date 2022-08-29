<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Orders;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use App\Http\Resources\OrderResource;
use App\Services\OrderService;
use App\Http\Requests\OrderRequest;
use App\Traits\ResponseMessage;

class OrderController extends Controller
{
    use ResponseMessage;

    public function __construct(OrderService $orderService)
    {
        $this->orderService = $orderService;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
  
        return OrderResource::collection($this->orderService->list());
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(OrderRequest $request)
    {
        $insert = $this->orderService->store($request);

        if($insert > 0){
            return $this->success('success', array('orderId' => $insert));
        }else{
            return $this->failure('error');
        }
    }


    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Orders  $Orders
     * @return \Illuminate\Http\Response
     */
    public function delete(int $id)
    {
        $delete = $this->orderService->delete($id);

        if($delete > 0){
            return $this->success('success', array('orderId' => $id));
        }else{
            return $this->failure('error');
        }
       
    }
}
