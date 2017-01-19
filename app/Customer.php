<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Customer extends Base_Model
{
    //
    public $primary_key = 'id';
    public $table = 'customer';
    protected $fillable = [
        'status',
        'name',
        'address',
        'phone_number',
        'fax_number',
        'main_charge',
        'extra_charge',
        'postal_code',
        'account_id',
        'created_at', 'updated_at',
        'created_by', 'updated_by'
    ];

    protected $limit = 10;

    /**
     * Function build rule to validation
     *
     * @param \Illuminate\Http\Request $request
     *
     * @return Array
     */
    public function rules(\Illuminate\Http\Request $request) {
        return [
            'status' => 'required|check_exist_customer_status',
            'name' => 'string',
            'phone_number' => 'check_phone_or_fax_number',
            'fax_number' => 'check_phone_or_fax_number',
            'postal_code' => 'check_postal_code',
            'type' => 'required|check_exist_customer_type',
        ];
    }

    /**
     * Function get data of get list
     *
     * @return json
     */
    public function get_data()
    {
        /** @var Object $res_customer Get list customer  */
        $res_customer = $this->paginate($this->limit);

        // Get info for pagination
        $paginate = $res_customer->toArray();
        unset($paginate['data']);

        $res_customer = $res_customer->all();

        // Attach customer to customer contact
        $this->_attach_customer_main_charge_name($res_customer);

        // Return
        return $this->true_json(
            $this->build_responses($res_customer),
            ['pagination' => $paginate]
        );
    }

    /**
     * Function use for create / update get data
     *
     * @param array $params
     * @internal param String $name
     * @internal param String $status
     * @internal param String $type
     * @internal param String $postal_code
     * @internal param String $remark
     * @internal param String $address
     * @internal param Integer $phone_number
     * @internal param Integer $fax_number
     * @internal param Integer $main_charge
     * @internal param Integer $extra_charge
     * @internal param Integer
     *
     * @return json
     */
    public function register_customer($params = [])
    {

        /**
         * TODO: return get dropdown for status, type, bill type
         */

        echo '<pre>';
        print_r($res_customer); die;
    }



    /**
     * Build response
     *
     * @param array $data
     */
    public function build_response($data, $option = [])
    {
//        if(!is_array($data)) {
//            return [];
//        }

        return $this->build_response_customer($data);
    }


}
