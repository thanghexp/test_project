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
     */
    public function get_list($params = [])
    {
        /** @var Object $res_customer Get list customer  */
        $res_customer = $this->paginate($this->limit);

        $paginate = $res_customer;
        $res_customer = $res_customer->all();

        // Attach customer to customer contact
        $this->_attach_customer_main_charge_name($res_customer);

        $res_customer = $this->build_responses($res_customer);

        echo '<pre>';
        print_r($res_customer); die;
        print_r($this->true_json($res_customer)); die;

        // Return
        return [
                 'items' => $this->true_json( $this->build_responses($res_customer) ),
                 'pagination' => $paginate
            ];
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
