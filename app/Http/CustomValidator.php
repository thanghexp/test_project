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

    public function validateCheckExistCustomerType($attribute, $value, $parameters)
    {
        $master_catalog = \App\Master_catalog::get()->toArray();
        $data_master_catalog = [];
        foreach($master_catalog AS $value) {
            $data_master_catalog[] = $value['code'];
        }
        if(in_array($value, $data_master_catalog)) {
            return true;
        }
        return false;
    }


}