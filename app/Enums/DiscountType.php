<?php
namespace App\Enums;

enum DiscountType : string
{
    case Thousand_Buy_Ten_Discount                        = 'App\Services\_orderDiscount\Thousand_Buy_Ten_Discount';
    case Two_Category_Six_Buy_One_Free                    = 'App\Services\_orderDiscount\Two_Category_Six_Buy_One_Free';
    case One_Category_Two_Buy_Cheapest_Twenty_Discount    = 'App\Services\_orderDiscount\One_Category_Two_Buy_Cheapest_Twenty_Discount';
}

