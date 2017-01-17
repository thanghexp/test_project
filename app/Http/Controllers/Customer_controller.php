<?php

namespace App\Http\Controllers;

use App\Http\Requests\CheckCustomerRequest;
use App\Master_catalog;
use Validator;
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

        /** @var array $res_customer  */
        $res_customer = $customer->paginate(5)->toArray();
        
        $data_customers = !empty($res_customer['data']) ? $res_customer['data'] : NULL;

        $this->_attach_customer_main_charge_name($data_customers);

        $data['title'] = 'Customer - List';
        $data['customers'] = $data_customers;
        $data['pagination'] = [
            'total' =>  !empty($res_customer['total']) ? (int) $res_customer['total'] : 0,
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

    /**
     * Register customer
     *
     *
     */
    public function create()
    {
        /** @var object $res_master_catalog get list master catalog */
        $res_master_catalog = \App\Master_catalog::get();

        // Array mapping to master catalog get customer status
        $customer_status = [];
        $customer_types = [];
        $customer_bill_types = [];
        foreach($res_master_catalog AS $catalog) {

            if($catalog->type == env('CUSTOMER_STATUS')) {
                $customer_status[] = $catalog->code;
            }

            if($catalog->type == env('CUSTOMER_TYPE')) {
                $customer_types[] = $catalog->code;
            }

            if($catalog->type == env('CUSTOMER_BILL_TYPE')) {
                $customer_bill_types[] = $catalog->code;
            }
        }

        /** @var $res_customer_contact*/
        $data['customer_contacts'] = \App\Customer_contact::get();

        $data['accounts'] = \App\Account::get();

        $data['customer_status'] = $customer_status;
        $data['customer_types'] = $customer_types;
        $data['customer_bill_types'] = $customer_bill_types;

        $data['page_title'] = 'Register customer';
        $data['title'] = 'Register - Customer';

        // Load view
        return view('customer.create', $data);
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'customer_name' => 'required',
            'status' => 'required|exist_customer_type',
        ]);

//        if ($validator->fails()) {
//            return redirect('customer/create')
//                ->withErrors($validator, 'error')
//                ->withInput();
//        }
        \App\Customer::create($request->all());
    }

}
