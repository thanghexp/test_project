<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class BaseController extends Controller
{
    /**
     * Function 
     * @param array $customers
     */
    public function _attach_customer_main_charge_name(& $customers)
    {
    	$data_customers = [];
    	foreach($customers AS $key => $customer) {
    		$data_customers[$customer['id']] = $customer;
    		$data_customers[$customer['id']]['main_charge_name'] = '';
            $data_customers[$customer['id']]['main_charge_contact'] = ''; 
    	}	

    	$res_customer_contacts = \App\Customer_contact::get()->toArray();

    	// Mapping to customer_contact
    	array_map(function($v) use(& $data_customers) {
            foreach($data_customers AS &$customer) {
                if($v['id'] == $customer['main_charge']) {
                    $customer[$customer['id']]['main_charge_name'] = $v['name'];
                    $customer[$customer['id']]['main_charge_contact'] = $v['priority_contact_type'];
                }       
            }
			
    	}, $res_customer_contacts);

        $customers = $data_customers;

    }

}