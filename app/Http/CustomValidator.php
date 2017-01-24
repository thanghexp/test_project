<?php
namespace App\Http;


class CustomValidator
{
    public function validateStrength($attribute, $value, $parameters, $validator)
    {
        if( preg_match('/(?=^.{8,}$)(?=.*\d)(?=.*[!@#$%^&*]+)(?![.\n])(?=.*[A-Z])(?=.*[a-z]).*$/', $value) )
            return true;

        return false;
    }

    /**
     * Function validate customer type have exist
     * @param string @value
     *
     * @return bool
     */
    public function check_exist_customer_contact($attribute, $value, $parameters) {
        // Load model
        $customer_contact_model = new \App\Customer_contact();

        // Get @var Object $master_catalog Get list data from customer contact table
        $res_customer_contact = $customer_contact_model->get_list_data();

        $data_customer_contacts = [];
        foreach($res_customer_contact AS $customer_contact) {
            $data_customer_contacts[] = $customer_contact->id;
        }

        if(!in_array($value, $data_customer_contacts)) {
            return false;
        }

        return true;
    }

    /**
     * Function validate customer type have exist
     * @param string @value
     *
     * @return bool
     */
    public function check_exist_customer_type($attribute, $value, $parameters)
    {
        // Get @var Object $master_catalog Get list data from master catalog table
        $master_catalog = \App\Master_catalog::get()
            ->where('type' , env('CATALOG_CUSTOMER_TYPE'))
            ->toArray();

        $data_master_catalog = [];
        foreach($master_catalog AS $item) {
            $data_master_catalog[] = $item['code'];
        }

        foreach($value AS $item) {
            if(!in_array($item, $data_master_catalog)) {
                return false;
            }
        }

        return true;
    }

    /**
     * Function validate customer status have exist
     * @param string @value
     *
     * @return bool
     */
    public function check_exist_customer_status($attribute, $value, $parameters)
    {
        /** @var array $master_catalog Get list Master catalog */
        $master_catalog = \App\Master_catalog::get()
            ->where('type' , env('CATALOG_CUSTOMER_STATUS'))
            ->toArray();

        $data_master_catalog = [];
        foreach($master_catalog AS $item) {
            $data_master_catalog[] = $item['code'];
        }
        unset($master_catalog);

        if(in_array($value, $data_master_catalog)) {
            return true;
        }
        return false;
    }

    /**
     * Function validate check phone or fax format correct
     */
    public function check_phone_or_fax_number($attribute, $value, $parameters)
    {
        if(preg_match('/[0-9]{9,11}/', $value)) {
            return true;
        }
        return false;
    }

    /**
     * Function validate check postal code format correct
     */
    public function check_postal_code($attribute, $value, $parameters)
    {
        if(preg_match('/[0-9]{3}\-[0-9]{4}/', $value)) {
            return true;
        }
        return false;
    }


}