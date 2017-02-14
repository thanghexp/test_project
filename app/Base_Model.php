<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Base_Model extends App_Model
{
    protected $primaryKey = '';
    protected $table = '';
    protected $fillable = [];
    public $constants = [];

    public function __construct()
    {
        parent::__construct();
        $this->constants = $this->default_constant;
    }

    /**
     * Function to export csv
     *
     * @param array $data
     * @param array $schema
     *
     * @return
     */
    public function export_csv($data = [])
    {
        // output headers so that the file is downloaded rather than displayed
        header('Content-type: text/csv');
        header(sprintf('Content-Disposition: attachment; filename="%s"', $this->name_csv));

        // do not cache the file
        header('Pragma: no-cache');
        header('Expires: 0');

        // create a file pointer connected to the output stream
        $file = fopen('php://output', 'w');

        $schema = $this->_schema();

        // send the column headers
        fputcsv($file, $schema);

        // output each row of the data
        if(!empty($data)) {
            foreach ($data as $item) {
                $row = [];
                foreach($schema as $header) {
                    $row[$header] = !empty($item[$header]) ? $item[$header] : '';
                }
                fputcsv($file, $row);
            }
        }

        //exit();
    }

    /**
     * Function get list value type of catalog
     *
     * @param string $param
     *
     * @return Object
     */
    public function _get_value_master_catalog($param = [])
    {
        if(empty($param['type'])) return null;

        // Load model
        $master_catalog = new \App\Master_catalog();

        // Return Object filter follow type
        return $master_catalog
            ->get()
            ->where('type', $param['type'])
            ->all();
    }

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

            // init customer main charge name and main charge contact
            $data_customers[$customer->id] = $customer;
            $data_customers[$customer->id]->main_charge_name = '';
            $data_customers[$customer->id]->main_charge_contact = '';
        }

        /** @var object $res_customer_contacts Get list customer contact */
        $res_customer_contacts = \App\Customer_contact::get()
            ->all();

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

        // Assign data for cursor
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

            // Get info contact
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

        /** Todo: Get info location of customer  */
        $customer_locations = new \App\Customer_location();

        /** @var object $res_customer_contacts Get list customer contact */
        $res_customer_contacts = $customer_contact
            ->get()
            ->all();

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

        $customers = $data_customers;

        unset($data_customers);
    }

    /**
     * Function Attach iw get info detail
     *
     */
    public function _attach_detail_industrial_waste(& $industrial_wastes)
    {
          $data_industrial_wastes = [];
          foreach($industrial_wastes AS $industrial_waste) {

               // Get info necessary of industrial waste
                $data_industrial_wastes[$industrial_waste->id] = $industrial_waste;
                $data_industrial_wastes[$industrial_waste->id]->client_customer_name = null;
                $data_industrial_wastes[$industrial_waste->id]->logistic_customer_name = null;
                $data_industrial_wastes[$industrial_waste->id]->type_name = null;
          }

          // Load model
          $customer_model = new \App\Customer();
          $master_catalog_model = new \App\Master_catalog();

          /** @var object $res_customer Get list customer from model */
          $res_customer = $customer_model->get_list();

          // Attach customer name
          array_map(function($v) use(& $data_industrial_wastes) {
            foreach($data_industrial_wastes as $industrial_waste ) {

              if($industrial_waste->client_customer_id == $v->id) {
                $data_industrial_wastes[$industrial_waste->id]->client_customer_name = !empty($v->name) ? $v->name : null;
              }

              if($industrial_waste->logistic_customer_id == $v->id) {
                $data_industrial_wastes[$industrial_waste->id]->logistic_customer_name = !empty($v->name) ? $v->name : null;
              }

            }
          }, $res_customer);
        unset($res_customer);

        /** @var object $res_master_catalog Get list master catalog from model */
        $res_iw_type = $master_catalog_model->_get_value_master_catalog([
            'type' => config('config.INDUSTRIAL_WASTE_TYPE')
        ]);

        // Attach type name
        array_map(function($v) use(& $data_industrial_wastes) {
            foreach($data_industrial_wastes as $industrial_waste ) {
                if($industrial_waste->type == $v->code) {
                    $data_industrial_wastes[$industrial_waste->id]->type_name = !empty($v->value) ? $v->value : null;
                }
            }
        }, $res_iw_type);
        unset($res_iw_type);

        $industrial_wastes = $data_industrial_wastes;

        unset($data_industrial_wastes);

    }


    /**
     * Function build definition
     *
     * @param string $status_bitmask
     * @param array $option
     *
     * @return array
     */
    public function build_definition_data($status_bitmask, $option = [])
    {
        // Load model
        $master_catalog_model = new \App\Master_catalog();

        if(empty($option['type'])) return null;

        /** @var Object $res_definition Get list master catlog */
        $res_definition = $master_catalog_model->get_value_master_catalog($option);

        // Handle definition status
        $data_definition = [];
        array_map(function($v) use(& $status_bitmask, & $data_definition ) {
            for($i = 0; $i < strlen($status_bitmask); $i++) {
                if ($i + 1 == $v->ordering) {
                    $data_definition[$v->code] = $v;
                    $data_definition[$v->code]->status = (int)$status_bitmask[$i];

                    break;
                }
            }
        }, $res_definition);

        return $data_definition;
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
                'customer_contacts' => !empty($data->contacts) ? $data->contacts : [],
                'customer_locations' => !empty($data->locations) ? $data->locations : []
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
     * Function build response account
     *
     * @param array $data
     * @param mixed $option
     *
     * @return array
     */
    public function build_response_industrial_waste($data, $option = [])
    {
        $data_industrial_waste = [
            'id' => (int) $data->id,
            'ticket_name' => !empty($data->ticket_name) ? $data->ticket_name : null,
            'take_off_at' => !empty($data->take_off_at) ? $data->take_off_at : null,
            'client_customer_id' => !empty($data->client_customer_id) ? $data->client_customer_id : null,
            'client_customer_name' => !empty($data->client_customer_name) ? $data->client_customer_name : null,
            'manifest_no' => !empty($data->manifest_no) ? $data->manifest_no : null,
            'manifest_issue_date' => !empty($data->manifest_issue_date) ? $data->manifest_issue_date : null,
            'quantity' => !empty($data->quantity) ? $data->quantity : null,
            'unit' => !empty($data->unit) ? $data->unit : null,
            'unit_price' => !empty($data->unit_price) ? $data->unit_price : null,
            'quantity_in_box' => !empty($data->quantity_in_box) ? $data->quantity_in_box : null,
            'quantity_total_box' => !empty($data->quantity_total_box) ? $data->quantity_total_box : null,
            'disposal' => !empty($data->disposal) ? $data->disposal : null,

            'type' => !empty($data->type) ? $data->type : null,
            'type_name' => !empty($data->type_name) ? $data->type_name : null,
            'logistic_customer_id' => !empty($data->logistic_customer_id) ? $data->logistic_customer_id : null,
            'logistic_customer_name' => !empty($data->logistic_customer_name) ? $data->logistic_customer_name : null,
            'method_deliver' => !empty($data->method_deliver) ? $data->method_deliver : null,
            'freight_rate' => !empty($data->freight_rate) ? $data->freight_rate : null,
            'freight_rate_original' => !empty($data->freight_rate_original) ? $data->freight_rate_original : null,
            'take_off_time' => !empty($data->take_off_time) ? $data->take_off_time : null,

            'car_number' => !empty($data->car_number) ? $data->car_number : null,
            'driver_name' => !empty($data->driver_name) ? $data->driver_name : null,
            'take_off_note' => !empty($data->take_off_note) ? $data->take_off_note : null,
            'installation_at' => !empty($data->installation_at) ? $data->installation_at : null,
            'box_number' => !empty($data->box_number) ? $data->box_number : null,
            'completed_at' => !empty($data->completed_at) ? $data->completed_at : null,
            'loading_place' => !empty($data->loading_place) ? $data->loading_place : null,
            'definition_data' => !empty($data->definition_data) ? $data->definition_data : null,

            'loading_location_remasks' => !empty($data->loading_location_remasks) ? $data->loading_location_remasks : null
        ];

        // Return
        return !empty($data_industrial_waste) ? $data_industrial_waste : [];
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

    /**
     * Function common to build response
     *
     * @param
     */


}
