<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Base_Model extends App_Model
{
    protected $primaryKey = '';
    protected $table = '';
    protected $fillable = [];



    /**
     * Function attach info of customer contact into customer
     *
     * @param array $customers
     */
    public function _attach_customer_main_charge_name(& $customers)
    {
        $id_customer = [];
        $data_customers = [];
        foreach($customers AS $key => $customer) {
            // Get id customer
            $id_customer[] = $customer->id;

            $data_customers[$customer->id] = $customer;
            $data_customers[$customer->id]->main_charge_name = '';
            $data_customers[$customer->id]->main_charge_contact = '';
        }

        /** @var object $res_customer_contacts Get list customer contact */
        $res_customer_contacts = \App\Customer_contact::get()->all();

        // Mapping to customer_contact
        array_map(function($v) use(&$data_customers) {
            foreach($data_customers AS &$customer) {
                if($v->id == $customer->main_charge) {
                    $data_customers[$customer->id]->main_charge_name = $v->name;
                    $data_customers[$customer->id]->main_charge_contact = $v->priority_contact_type;
                }
            }

        }, $res_customer_contacts);
        unset($res_customer_contacts);

        $customers = $data_customers;

        unset($data_customers);
    }


    /**
     * Function Attach customer get info detail
     *
     */
    public function _attach_detail_customer(& $customers)
    {
        $data_customers = [];
        foreach($customers as $customer) {
            $data_customers[$customer->id] = $customer;
            $data_customers[$customer->id]->main_charge_name = NULL;
            $data_customers[$customer->id]->main_charge_contact = NULL;
            $data_customers[$customer->id]->extra_charge_name = NULL;
            $data_customers[$customer->id]->account_name = NULL;
            $data_customers[$customer->id]->customer_contact = [];
            $data_customers[$customer->id]->customer_location = [];
        }

        // Load model
        $customer_contact = new \App\Customer_contact();
        $customer_locations = new \App\Customer_location();

        /** @var object $res_customer_contacts Get list customer contact */
        $res_customer_contacts = $customer_contact->get()->all();

        // Mapping to customer_contact
        array_map(function($v) use(&$data_customers) {
            foreach($data_customers AS &$customer) {

                // Get main charge name
                if($v->id == $customer->main_charge) {
                    $data_customers[$customer->id]->main_charge_name = $v->name;
                    $data_customers[$customer->id]->main_charge_contact = $v->priority_contact_type;
                }

                // Get extra charge name
                if($v->id == $customer->extra_charge) {
                    $data_customers[$customer->id]->extra_charge_name = $v->name;
                }

            }
        }, $res_customer_contacts);
        unset($res_customer_contacts);

        /** @var object $res_customer_locations Get list customer location */
        $res_customer_locations = $customer_locations->get_list();

        // Mapping to customer_locations
        $data_locations = [];
        array_map(function($v) use(&$data_customers) {
            foreach($data_customers AS $customer) {
                if($v->customer_id == $customer->id) {
                    $data_customers[$customer->id]->customer_location = $v;
                }
            }
        }, $res_customer_locations);
        unset($res_customer_locations);

        dd($data_customers);

        /** @var object $res_customer_locations Get list customer location */
        $res_customer_contacts = $customer_contact->get_list();

        // Mapping to customer_locations
        array_map(function($v) use(&$data_customers) {
            foreach($data_customers AS &$customer) {
                if($v->customer_id == $customer->id) {
                    $data_customers[$customer->id]->customer_contact = $v;
                }
            }
        }, $res_customer_contacts);
        unset($res_customer_contacts);

        $customers = $data_customers;

        unset($data_customers);
    }

    /**
     * Function attach info account
     */
    public function _attach_detail_account(& $res_account)
    {
        $data_account = [];
        foreach($res_account AS $account) {
            $data_account[$account->id] = $account;
        }

        $res_account = $data_account;
    }

    /**
     * Function attach info of customer contact
     */
    public function _attach_detail_customer_contact(& $res_customer_contact)
    {
        $data_account = [];
        foreach($res_customer_contact AS $account) {
            $data_account[$account->id] = $account;
        }

        $res_customer_contact = $data_account;
    }



    /**
     * Function build response customer
     *
     * @param array customer
     *
     * @return array
     */
    public function build_response_customer($data, $option = [])
    {
        $data_customer = [
            'id' => $data->id,
            'name' => !empty($data->name) ? $data->name : NULL,
            'postal_code' => !empty($data->postal_code) ? $data->postal_code : NULL,
            'status' => !empty($data->status) ? $data->status : NULL,
            'customer_name' => !empty($data->name) ? $data->name : NULL,
            'address' => !empty($data->address) ? $data->address : NULL,
            'fax_number' => !empty($data->fax_number) ? $data->fax_number : NULL,
            'phone_number' => !empty($data->phone_number) ? $data->phone_number: NULL,
            'main_charge' => !empty($data->main_charge) ? $data->main_charge : NULL,
            'main_charge_name' => !empty($data->main_charge_name) ? $data->main_charge_name : NULL,
            'main_charge_contact' => !empty($data->main_charge_contact) ? $data->main_charge_contact : NULL,
            'main_charge_extra' => !empty($data->main_charge_extra) ? $data->main_charge_extra : NULL,
        ];

        if(isset($option['detail'])) {
            $data_detail = [
                'customer_contacts' => !empty($data->customer_contact) ? $data->customer_contact : [],
                'customer_locations' => !empty($data->customer_location) ? $data->customer_location : []
            ];

        }

        // Return
        return array_merge($data_customer, !empty($data_detail) ? $data_detail : []);
    }

    /**
     * Function build response account
     *
     * @param array $data
     * @param mixed $option
     *
     * @return array
     */
    public function build_response_account($data, $option = [])
    {
        $data_account = [
            'id' => (int) $data->id,
            'status' => !empty($data->status) ? $data->status : NULL,
            'email' => !empty($data->email) ? $data->email : NULL,
            'role_id' => !empty($data->role_id) ? $data->role_id : NULL,
            'phone_number' => !empty($data->phone_number) ? $data->phone_number : NULL,
            'name' => !empty($data->name) ? $data->name : NULL,
        ];

        // Return
        return !empty($data_account) ? $data_account : NULL;
    }

    /**
     * Function build response account
     *
     * @param array $data
     * @param mixed $option
     *
     * @return array
     */
    public function build_response_customer_contact($data, $option = [])
    {
        $data_account = [
            'id' => (int) $data->id,
            'customer_id' => !empty($data->customer_id) ? $data->customer_id : NULL,
            'status' => !empty($data->status) ? $data->status : NULL,
            'name' => !empty($data->name) ? $data->name : NULL,
            'position' => !empty($data->position) ? $data->position : NULL,
            'phone_number' => !empty($data->phone_number) ? $data->phone_number : NULL,
            'mobile_number' => !empty($data->mobile_number) ? $data->mobile_number : NULL,
            'email' => !empty($data->email) ? $data->email : NULL,
        ];

        // Return
        return !empty($data_account) ? $data_account : [];
    }

    /**
     * Function build response master catalog
     *
     * @param array master catalog
     */
    public function build_response_master_catalog($data, $option = [])
    {
        $data_master_catalog = [
            'type' => !empty($data->type) ? $data->type : NULL,
            'value' => !empty($data->value) ? $data->value : NULL,
            'code' => !empty($data->code) ? $data->code : NULL
        ];

        // Return
        return !empty($data_master_catalog) ? $data_master_catalog : [];
    }

    /**
     * Function build response customer type
     *
     * @param array customer type
     */
    public function build_response_customer_type($data, $option = [])
    {
        $data_customer_type = [
          'customer_id' => !empty($data->customer_id) ? (int) $data->customer_id : NULL,
          'type' => !empty($data->type) ? $data->type : NULL
        ];

        // Returm
        return !empty($data_customer_type) ? $data_customer_type : [];
    }

}
