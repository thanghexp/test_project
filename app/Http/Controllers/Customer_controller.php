<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class Customer_controller extends AppController
{
    /**
     * Show list customer
     */
    public function index()
    {
        $data = ['arg' => '1'];

        // Load model
        $customer = new \App\Customer();

        $data['customers'] = !empty($customer) ? $customer->get()->toArray() : NULL;

        // Load view
        return $this->_render('customer.index', $data);
    }

    public function create()
    {

    }




}
