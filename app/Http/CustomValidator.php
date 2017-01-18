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
    public function check_exist_customer_type($attribute, $value, $parameters)
    {
        $master_catalog = \App\Master_catalog::get()
            ->where('type' , env('CUSTOMER_TYPE'))
            ->toArray();

        $data_master_catalog = [];
        foreach($master_catalog AS $item) {
            $data_master_catalog[] = $item['code'];
        }

        foreach($data_master_catalog AS $item_catalog) {
            if(in_array($item_catalog, $value)) {
                return true;
            }
        }

        return false;
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
            ->where('type' , env('CUSTOMER_STATUS'))
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