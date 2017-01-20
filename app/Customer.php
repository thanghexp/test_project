<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Customer extends Base_Model
{
    public $fillable = [
        'status',
        'account_id',
        'name',
        'address',
        'phone_number',
        'fax_number',
        'main_charge',
        'extra_charge',
        'postal_code',
        'created_at', 'updated_at',
        'created_by', 'updated_by'
    ];

    public $primaryKey = 'id';
    public $table = 'customer';

    protected $limit = 10;

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
            'name' => 'string',
            'phone_number' => 'check_phone_or_fax_number',
            'fax_number' => 'check_phone_or_fax_number',
            'postal_code' => 'check_postal_code',
            'type' => 'required|check_exist_customer_type',
        ];
    }

    /**
     * Function get list data of customer
     *
     * @return json
     */
    public function get_data()
    {
        /** @var Object $res_customer Get list customer  */
        $res_customer = $this->paginate($this->limit)->toSql();

        echo '<pre>';
        print_r($res_customer); die;

        // Get info for pagination
        $paginate = $res_customer->toArray();
        unset($paginate['data']);

        $res_customer = $res_customer->all();

        // Attach customer to customer contact
        $this->_attach_customer_main_charge_name($res_customer);

        // Return
        return $this->true_json([
            'items' => $this->build_responses($res_customer),
            'pagination' => $paginate
        ]);
    }

    /**
     * Function get detail data of customer
     *
     * @param array $params
     * @internal param $id
     */
    public function get_detail($params = [])
    {
        if(empty($params['id'])) {
            return;
        }

        /** @var object $res_customer Get list all */
        $res_customer = $this->find($params['id']);

        $res_customer = [$res_customer];

        // Attach customer to get main charge name
        $this->_attach_detail_customer($res_customer);

        return $this->true_json( $this->build_response($res_customer[$params['id']]) );
    }

    /**
     * Function get info for update customer
     *
     * @param array $params
     * @return array
     */
    public function update_data($id = NULL)
    {

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
