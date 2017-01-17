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
        // Load model
        $customer = new \App\Customer();

        $deb = $customer->get_list([
            'where' => ['id' => 5]
        ]);

        echo '<pre>';
        print_r($deb->getAttributes()['id']); die;

        /** @var object $res_customer */
        $res_customer = $customer->paginate(5)->toArray();
        
        $data_customers = !empty($res_customer['data']) ? $res_customer['data'] : NULL;
        
        // Attach main charge name
        $this->_attach_customer_main_charge_name($data_customers);

        $data['title'] = 'Customer - List';
        $data['customers'] = $data_customers;
        $data['pagination'] = [
            'total' => $res_customer['total'],
            'per_page' => $res_customer['per_page'],
            'current_page' => $res_customer['current_page'],
            'last_page' => $res_customer['last_page'],
            'next_page_url' => $res_customer['next_page_url'],
            'prev_page_url' => $res_customer['prev_page_url'],
            'from' => $res_customer['from'],
            'to' => $res_customer['to']
        ];

        // Load view
        return view('customer.index', $data);
    }

    public function create()
    {
        $data['page_title'] = 'Register customer';
        $data['title'] = 'Register - Customer';

        // Load view
        return view('customer.create', $data);
    }

}
