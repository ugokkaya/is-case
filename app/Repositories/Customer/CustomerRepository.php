<?php
namespace App\Repositories\Customer;

use App\Repositories\Customer\CustomerRepositoryInterface;
use App\Models\Customers;

class CustomerRepository implements CustomerRepositoryInterface
{
    public function getAll(){
        return Customers::all();
    }

}