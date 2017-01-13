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

        $customer = new \App\Customer();



        return $this->_render('customer.index', $data);
    }

    public function create()
    {

    }




}
