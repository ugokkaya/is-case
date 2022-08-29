<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\OrderDiscountRequest;
use Illuminate\Http\Request;
use App\Services\OrderDiscountService;


class OrderDiscountController extends Controller
{
    public function __construct(OrderDiscountService $orderDiscountService)
    {
        $this->orderDiscountService = $orderDiscountService;
    }

    public function index(OrderDiscountRequest $request)
    {
       return $this->orderDiscountService->discountCalculate($request->orderId);
    }
    
}
