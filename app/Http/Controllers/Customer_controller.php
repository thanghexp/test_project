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

        $data['customers'] = $res_customer['data']['items'];
        $data['pagination'] = $res_customer['data']['pagination'];

        // Load view
        return view('customer.index', $data);
    }

    /**
     * Register customer
     *
     * $param Illuminate\Http\Request $request
     */
    public function create()
    {
        // Load model
        $master_catalog = new \App\Master_catalog();
        $account = new \App\Account();
        $customer_contact = new \App\Customer_contact();

        /** @var $res_customer_contact*/
        $res_customer_contacts = $customer_contact->get_list_data()->getData(TRUE);
        $res_accounts = $account->get_list_data()->getData(TRUE);

        $customer_status = $master_catalog->get_value_master_catalog([
            'type' => env('CATALOG_CUSTOMER_STATUS')
        ])->getData(TRUE);

        $customer_type = $master_catalog->get_value_master_catalog([
            'type' => env('CATALOG_CUSTOMER_TYPE')
        ])->getData(TRUE);

        $bill_types = $master_catalog->get_value_master_catalog([
            'type' => env('CATALOG_CUSTOMER_BILL_TYPE')
        ])->getData(TRUE);

//        $data['customer_id'] =
        $data['customer_status'] = $customer_status['items'];
        $data['customer_types'] = $customer_type['items'];
        $data['customer_bill_types'] = $bill_types['items'];
        $data['customer_contacts'] = $res_customer_contacts['items'];
        $data['accounts'] = $res_accounts['items'];

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
        $customer_type = new \App\Customer;

        $params = $request->all();
        $params['created_by'] = 'admin:1';
        $params['updated_by'] = 'admin:1';
        $params['account_id'] = 1;

        $save_customer = $customer->create($params);

        foreach($params['type'] AS $value) {
            $customer_type->create(['type' => $value]);
        }

        return redirect('customer/detail/' . $save_customer->id);
    }

    /**
     * View update info customer
     */
    public function update($id)
    {
        // Load model
        $customer = new \App\Customer();
        $customer_type = new \App\Customer_type();

        /** @var object $res_customer Get list data of customer */
        $res_customer = $customer->find($id);

        /** @var object $res_customer_type Get list data of customer type */
        $res_customer_type = $customer_type->get()->all();

        foreach($res_customer_type as $customer_type) {
            if($res_customer->id == $customer_type->customer_id) {
                $res_customer->customer_type[] = $customer_type->type;
            }
        }

        echo '<pre>';
        print_r($res_customer); die;

        $data['data_customer'] = $res_customer;

        // Load model
        $master_catalog = new \App\Master_catalog();
        $account = new \App\Account();
        $customer_contact = new \App\Customer_contact();

        /** @var $res_customer_contact*/
        $res_customer_contacts = $customer_contact->get_list_data()->getData(TRUE);
        $res_accounts = $account->get_list_data()->getData(TRUE);

        $customer_status = $master_catalog->get_value_master_catalog([
            'type' => env('CATALOG_CUSTOMER_STATUS')
        ])->getData(TRUE);

        $customer_type = $master_catalog->get_value_master_catalog([
            'type' => env('CATALOG_CUSTOMER_TYPE')
        ])->getData(TRUE);

        $bill_types = $master_catalog->get_value_master_catalog([
            'type' => env('CATALOG_CUSTOMER_BILL_TYPE')
        ])->getData(TRUE);

        $data['edit_data'] = TRUE;
        $data['customer_status'] = $customer_status['items'];
        $data['customer_types'] = $customer_type['items'];
        $data['customer_bill_types'] = $bill_types['items'];
        $data['customer_contacts'] = $res_customer_contacts['items'];
        $data['accounts'] = $res_accounts['items'];

        $data['page_title'] = 'Register customer';
        $data['title'] = 'Register - Customer';

        // Load view
        return view('customer.create', $data);
    }

    /**
     * Get detail information of customer
     *
     * $param integer $id
     *
     * @return array
     */
    public function detail($id)
    {
        $customer = new \App\Customer;

        /** @var object $res_customer Get info detail of customer */
        $res_customer = $customer->get_detail(['id' => (int) $id])
            ->getData(TRUE);

        $data['title'] = 'Customer - detail | ' . env('APP_NAME');
        $data['data_customer'] = !empty($res_customer['items']) ? $res_customer['items'] : NULL;

        return view('customer/detail', $data);
    }

}
