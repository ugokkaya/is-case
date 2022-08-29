<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OrderItems extends Model
{
    use HasFactory;

     /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['orderId', 'productId', 'quantity', 'unitPrice', 'total'];
    protected $visible = ['productId', 'quantity', 'unitPrice', 'total'];

}
