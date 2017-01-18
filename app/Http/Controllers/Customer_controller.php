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

        $customer->get_list();
        
        $data_customers = !empty($res_customer['data']) ? $res_customer['data'] : NULL;

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
     */
    public function create(Request $request)
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

    /**
     * Save register of customer
     */
    public function store(Request $request)
    {
        // Load model
        $customer = new \App\Customer;

        $params = $request->input();
        $params['created_by'] = 'admin:1';
        $params['updated_by'] = 'admin:1';

        $save_customer = \App\Customer::create($params);

        return redirect('customer/detail/' . $save_customer->id);
    }

    /**
     * View update info customer
     */
    public function update($id)
    {
        // Load model
        $customer = new \App\Customer();

        /** @var object $res_customer Get detail customer   */
        $res_customer = $customer->get()->find((int) $id)->toArray();

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

        $data['page_title'] = 'Update customer';
        $data['title'] = 'Update - Customer';

        return view('customer/create');
    }

    /**
     * Show detail information of customer
     */
    public function detail($id)
    {
        if(empty($id)) {
           return;
        }

        // Load model
        $customer = new \App\Customer;

        /** @var object $res_customer Get detail customer   */
        $res_customer = $customer->get()->find((int) $id)->toArray();

        $res_customer = [$res_customer];

        $this->_attach_customer_main_charge_name($res_customer);

        $data['title'] = 'Customer - detail | ' . env('APP_NAME');
        $data['data_customer'] = $res_customer[$id];

        return view('customer/detail', $data);
    }

    /**
     * Function common for create and update with dropdown
     */
    public function _get_dropdown_create_update()
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


    }
}
