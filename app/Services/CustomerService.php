<?php

namespace App\Services;

use App\Repositories\Customer\CustomerRepository;


class CustomerService{

    private $customerRepository;

    public function __construct(CustomerRepository $customerRepository){
        $this->customerRepository = $customerRepository;
    }

    /**     
     * @return \Illuminate\Http\Response
    */
    public  function list(){
        return $this->customerRepository->getAll();
    }

}