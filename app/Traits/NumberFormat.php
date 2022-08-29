<?php
namespace App\Traits;

trait NumberFormat
{
    protected function doubleFormat($number, $decimal = 2)
    {
        return round($number, $decimal);
    }

}