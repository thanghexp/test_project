<?php

namespace App\Http\Controllers;

use App\Http\Requests\CheckCustomerRequest;
use App\Master_catalog;
use Illuminate\Support\Facades\Response;
use Validator;
use Illuminate\Http\Request;
use \App;

class Customer_controller extends AppController
{
    /**
     * Show list customer
     */
    public function index(Request $request)
    {
        // Load model
        $customer = new \App\Customer();

        $get_data = $request->all();
        $page = isset($get_data['page']) ? $get_data['page'] : 1;

        // Get offset and limit
        $params = $this->_params($page);

        /** @var array $res_customer Get list customer from Customer Model */
        $res_customer = $customer->get_data($params)->getData(TRUE);

        $data['title'] = 'Customer - List';
        $data['customers'] = $res_customer['data']['items'];

        // Get total
        $total = !empty($res_customer['data']['total']) ? (int) $res_customer['data']['total'] : null;

        // Set pagination to view
        $data['pagination'] = [
            'total' => (int) $total,
            'per_page' => ($total > $params) ? ($total % $params['limit'])  : 1,
            'current_page' =>  $page,
            'prev_page' =>  $page != 1 ? '?page=' . ($page - 1) : null,
            'next_page' =>   $page != ($total % $params['limit']) ? '?page=' . ($page + 1) : null,
        ];

        // Load view
        return view('customer.index', $data);
    }

    /**
     * Register customer
     *
     * $param Illuminate\Http\Request $request
     */
    public function create($id = null)
    {
        // Load model
        $master_catalog = new \App\Master_catalog();
        $account = new \App\Account();
        $customer_contact = new \App\Customer_contact();
        $customer = new \App\Customer();
        $customer_type = new \App\Customer_type();

        if(!is_null($id) &&  $res_customer = $customer->find($id) ) {

            /** @var object $res_customer_type Get list data of customer type */
            $res_customer_type = $customer_type->get()->all();

            $data_types = [];
            foreach ($res_customer_type as $item) {
                if ($res_customer->id == $item->customer_id) {
                    $data_types[] = $item->type;
                }
            }

            $res_customer->type = $data_types;

            $data['data_customer'] = $res_customer->toArray();
            $data['edit_data'] = TRUE;
        }

        /** @var $res_customer_contact */
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

        $data['customer_status'] = $customer_status['data'];
        $data['customer_types'] = $customer_type['data'];
        $data['customer_bill_types'] = $bill_types['data'];
        $data['customer_contacts'] = $res_customer_contacts['data'];
        $data['accounts'] = $res_accounts['data'];

        $data['page_title'] = 'Register customer';
        $data['title'] = 'Register - Customer';

        // Load view
        return view('customer.create', $data);
    }

    /**
     * Create new location 
     *  
     */
    public function create_location(Request $request, $id = null)
    {
        if($request->method() == 'POST') {
            // Get data post
            $params = $request->all();

            $customer_location_model = new App\Customer_location();

            // Call Model Customer location to create new
            $customer_location_model->create_customer_location(!empty($params) ? $params : []);

            return redirect('customer/detail/' . $params['customer_id']);
        }

        // Load model
        $master_catalog_model = new Master_catalog();
        $customer_contact_model = new App\Customer_contact();

        /** @var Object $res_master_catalog Get list data master catalog */
        $res_master_catalog = $master_catalog_model->get_value_master_catalog([
            'type' => env('CATALOG_CUSTOMER_STATUS')
        ])
        ->getData(TRUE);

        /** @var Object $res_customer_contact Get list data customer contact */
        $res_customer_contact = $customer_contact_model->get_list_data()->getData(TRUE);

        // Get dropdown for customer contact main_charge and extra data
        $data['customer_contacts'] = !empty($res_customer_contact) ? $res_customer_contact['data'] : [];
        $data['location_status'] = !empty($res_master_catalog) ? $res_master_catalog['data'] : [];
        $data['customer_id'] = $id;

        $data['title'] = 'Create location' . env('APP_NAME');
        return view('customer.create_location', $data);
    }

    /**
     * Save register of customer
     */
    public function store(Request $request)
    {
        // Load model
        $customer = new \App\Customer;

        $params = $request->all();
        $params['created_by'] = 'admin:1';
        $params['updated_by'] = 'admin:1';
        $params['account_id'] = 1;

        if(isset($params['id'])) {
            $customer->update_customer($params);
        } else {
            $new_id = $customer->save_customer($params);
        }

        return redirect('customer/detail/' . (isset($new_id) ? $new_id : $params['id'] ));
    }

    /**
     * View update info customer
     */
    public function update($id)
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

        $data['edit_data'] = TRUE;
        $data['customer_status'] = !empty($customer_status['data']) ? $customer_status['data'] : [];
        $data['customer_types'] = !empty($customer_type['data']) ? $customer_type['data'] : [];
        $data['customer_bill_types'] = !empty($bill_types['data']) ? $bill_types['data'] : [];
        $data['customer_contacts'] = !empty($res_customer_contacts['data']) ? $res_customer_contacts['data'] : [];
        $data['accounts'] = !empty($res_accounts['data']) ? $res_accounts['data'] : [];

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
        // Load model
        $customer = new \App\Customer;
        $customer_location_model = new \App\Customer_location();
        $customer_contact_model = new \App\Customer_contact();

        /** @var object $res_customer Get info detail of customer */
        $res_customer = $customer->get_detail(['id' => (int) $id])
            ->getData(TRUE);

        // dd($res_customer);

        $data['customer_locations'] = $customer_location_model->get_list();
        $data['customer_contacts'] = $customer_contact_model->get_list();

        $data['title'] = 'Customer - detail | ' . env('APP_NAME');
        $data['data_customer'] = !empty($res_customer['data']) ? $res_customer['data'] : NULL;

        return view('customer/detail', $data);
    }

}
