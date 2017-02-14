<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Customer_location extends Base_Model
{
    //
    public $primaryKey = 'id';
    public $table = 'customer_location';
    public $fillable = [
        'customer_id',
        'postal_code',
        'site_name',
        'address',
        'phone_number',
        'fax_number',
        'main_charge',
        'extra_charge',
        'consumption',
        'trading_unit_price',
        'forklift',
        'remark',
        'created_by',
        'updated_by'
    ];

    /**
     * Function build rule to validation
     *
     * @param \Illuminate\Http\Request $request
     *
     * @return array
     */
    public function rules(\Illuminate\Http\Request $request) {
        return [
            'status' => 'required',
            'site_name' => 'required|string',
            'main_charge' => 'check_exist_customer_contact',
            'extra_charge' => 'check_exist_customer_contact',
            'phone_number' => 'check_phone_or_fax_number',
            'fax_number' => 'check_phone_or_fax_number',
            'postal_code' => 'check_postal_code',
            'trading_unit_price' => 'string',
            'consumption' => 'string',
            'remark' => 'string'
        ];
    }

    /**
     * Function to get customer location
     *
     * @param array $param
     * @return array
     */
    public function get_list_data($params = []) {
        $res_customer_locations = $this->get_list($params);

        return $res_customer_locations;
    }

    /**
     * Function create customer location
     *
     * @param array $params
     * @internal String status
     * @internal String site_name
     * @internal Integer main_charge
     * @internal Integer extra_charge
     * @internal String phone_number
     * @internal String fax_number
     * @internal String postal_code
     * @internal String trading_unit_price
     * @internal Integer consumption
     * @internal String remark
     *
     * @return
     */
    public function create_customer_location($params = []) {
        if(empty($params)) {
            return null;
        }

        $this->save_data([
            'customer_id' => isset($params['customer_id']) ? (int) $params['customer_id'] : null,
            'status' => isset($params['status']) ? $params['status'] : null,
            'site_name' => isset($params['site_name']) ? $params['site_name'] : null,
            'main_charge' => isset($params['main_charge']) ? (int) $params['main_charge'] : null,
            'extra_charge' => isset($params['extra_charge']) ? (int) $params['extra_charge'] : null,
            'phone_number' => isset($params['phone_number']) ? $params['phone_number'] : null,
            'fax_number' => isset($params['fax_number']) ? $params['fax_number'] : null,
            'postal_code' => isset($params['postal_code']) ? $params['postal_code'] : null,
            'trading_unit_price' => !empty($params['trading_unit_price']) ? $params['trading_unit_price'] : 0,
            'consumption' => isset($params['consumption']) ? $params['consumption'] : null,
            'remark' => isset($params['remark']) ? $params['remark'] : null,
        ]);

    }

    public function build_response($data, $option = []) {
        return get_object_vars($data);
    }
}
