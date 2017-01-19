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

        /** @var array $res_customer Get list customer from Customer Model */
        $res_customer = $customer->get_data()->getData(TRUE);

        $data['title'] = 'Customer - List';
        $data['customers'] = $res_customer['items'];
        $data['pagination'] = $res_customer['pagination'];

        // Load view
        return view('customer.index', $data);
    }

    /**
     * Register customer
     *
     */
    public function create(Request $request)
    {
        /** TODO: message error when validation
         * TODO:
         */

        // Load model
        $customer = new \App\Customer();
        $master_catalog = new \App\Master_catalog();
        $account = new \App\Account();
        $customer_contact = new \App\Customer_contact();

        /** @var $res_customer_contact*/
        $data['customer_contacts'] = $customer_contact->get_list_data()->getData(TRUE);
        $data['accounts'] = $account->get_list_data()->getData(TRUE);

        $customer_status = $master_catalog->get_value_master_catalog([
            'type' => env('CATALOG_CUSTOMER_STATUS')
        ])->getData(TRUE);

        $customer_type = $master_catalog->get_value_master_catalog([
            'type' => env('CATALOG_CUSTOMER_TYPE')
        ])->getData(TRUE);

        $bill_types = $master_catalog->get_value_master_catalog([
            'type' => env('CATALOG_CUSTOMER_BILL_TYPE')
        ])->getData(TRUE);

        $data['customer_status'] = $customer_status['items'];
        $data['customer_types'] = $customer_type['items'];
        $data['customer_bill_types'] = $bill_types['items'];


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
