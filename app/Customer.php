<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
use Mockery\CountValidator\Exception;
use \App;

class Customer extends Base_Model
{
    public $fillable = [
        'id',
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
     * @param array $params
     * @param internal integer $offset
     * @param internal integer $limit
     *
     * @return json
     */
    public function get_data($params = [])
    {
        DB::enableQueryLog();

        /** @var Object $res_customer Get list customer  */
        $res_customer = $this->get_list($params);

        $this->_attach_customer_main_charge_name($res_customer);

        // Return
        return $this->true_json([
            'items' => $this->build_responses($res_customer),
            'total' => $this->count()
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
    public function save_customer($params = [])
    {
        try {
            DB::transaction(function () use ($params) {
                // Load model
                $customer_type_model = new Customer_type();
                $action_history_model = new Action_history();

                // Save customer
                $new_customer = $this->create([
                    'name' => !empty($params['name']) ? $params['name'] : '',
                    'status' => !empty($params['status']) ? $params['status'] : null,
                    'type' => !empty($params['type']) ? $params['type'] : null,
                    'postal_code' => !empty($params['postal_code']) ? $params['postal_code'] : null,
                    'remark' => !empty($params['remark']) ? $params['remark'] : null,
                    'address' => !empty($params['address']) ? $params['address'] : null,
                    'phone_number' => !empty($params['phone_number']) ? $params['phone_number'] : null,
                    'fax_number' => !empty($params['fax_number']) ? $params['fax_number'] : null,
                    'main_charge' => !empty($params['main_charge']) ? $params['main_charge'] : null,
                    'extra_charge' => !empty($params['extra_charge']) ? $params['extra_charge'] : null,
                    'created_by' => !empty($params['created_by']) ? $params['created_by'] : null,
                    'updated_by' => !empty($params['updated_by']) ? $params['updated_by'] : null,
                    'bill_type' => !empty($params['bill_type']) ? $params['bil_type'] : null
                ]);

                // Save customer type
                foreach ($params['type'] AS $type) {
                    $customer_type_model->create([
                        'customer_id' => (int)$new_customer->id,
                        'type' => !empty($type) ? $type : null,
                    ]);
                }

                // Save write log Time line
                $action_history_model->create([
                    'target_id' => $new_customer->id,
                    'action' => env('ACTION_CREATE'),
                    'account_id' => 1,
                    'object' => env('OBJECT_CUSTOMER'),
                    'extra_data' => json_encode([
                        'status' => !empty($params['status']) ? $params['status'] : null,
                        'status_name' => !empty($params['status_name']) ? $params['status_name'] : null,
                    ]),
                    'created_by' => 'admin:1',
                    'updated_by' => 'admin:1'
                ]);

                DB::commit();

            }, 5);

        } catch (Exception $e) {
            DB::rollback();
        }

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
    public function update_customer($params = [])
    {
        try {
            DB::transaction(function () use ($params) {
                // Load model
                $customer_type_model = new Customer_type();
                $action_history_model = new Action_history();

                // Save customer
                $new_customer = $this->where('id', (int) $params['id'])
                    ->update([
                        'name' => !empty($params['name']) ? $params['name'] : '',
                        'status' => !empty($params['status']) ? $params['status'] : null,
                        'postal_code' => !empty($params['postal_code']) ? $params['postal_code'] : null,
                        'remark' => !empty($params['remark']) ? $params['remark'] : null,
                        'address' => !empty($params['address']) ? $params['address'] : null,
                        'phone_number' => !empty($params['phone_number']) ? $params['phone_number'] : null,
                        'fax_number' => !empty($params['fax_number']) ? $params['fax_number'] : null,
                        'main_charge' => !empty($params['main_charge']) ? $params['main_charge'] : null,
                        'extra_charge' => !empty($params['extra_charge']) ? $params['extra_charge'] : null,
                        'created_by' => !empty($params['created_by']) ? $params['created_by'] : null,
                        'updated_by' => !empty($params['updated_by']) ? $params['updated_by'] : null,
//                        'bill_type' => !empty($params['bill_type']) ? $params['bill_type'] : null
                    ]);

                if(!empty($params['type'])) {
                    // Get @var object $res_customer_type exist in customer_type table
                    $res_customer_type = $customer_type_model->get_list([
                        'where' => [
                            'id' => $params['id']
                        ]
                    ])->all();

                    // Check $res_customer_type have not exist in  $params
                    foreach ($res_customer_type AS $type) {
                        if (!in_array($type, $params['type'])) {
                            $customer_type_model->delete()->where([
                                'customer_id' => (int)$params['id'],
                                'type' => !empty($type) ? $type : null,
                            ]);
                        }
                    }

                    // Check $param have not exist in $res_customer_type
                    foreach ($params['type'] AS $type) {
                        if (!in_array($type, $res_customer_type)) {
                            $customer_type_model->create([
                                'customer_id' => (int)$params['id'],
                                'type' => !empty($type) ? $type : null,
                            ]);
                        }
                    }
                }



                // =>
                // <= case 1:   create new customer type
                // <= case 2:
                // case : have data but remove some type



                // Save write log Time line
                $action_history_model->create([
                    'target_id' => $new_customer->id,
                    'action' => env('ACTION_UPDATE'),
                    'account_id' => 1,
                    'object' => env('OBJECT_CUSTOMER'),
                    'extra_data' => json_encode([
                        'status' => !empty($params['status']) ? $params['status'] : null,
                        'status_name' => !empty($params['status_name']) ? $params['status_name'] : null,
                    ]),
                    'created_by' => 'admin:1',
                    'updated_by' => 'admin:1'
                ]);

                DB::commit();

            }, 5);

        } catch (Exception $e) {
            DB::rollback();
        }

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
