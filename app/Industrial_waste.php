<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Excel;

class Industrial_waste extends Base_Model
{
    //
    public $table = 'industrial_waste';
    public $primaryKey = 'id';
    public $fillable = [
    	'id',
    	'ticket_name'
    ];

    public $name_csv = 'industrial_waste.csv';

    /**
     * Function get list data of customer
     *
     * @param array $params
     * @param internal integer $offset
     * @param internal integer $limit
     *
     * @return json
     */
    public function get_list_data($params = []) {
        /** @var Object $res_customer Get list customer  */
        $res_industrial_waste = $this->get_list($params);

        // Attach detail industrial waste
        $this->_attach_detail_industrial_waste($res_industrial_waste);

        foreach($res_industrial_waste as $iw) {
            $res_industrial_waste[$iw->id]->definition_data = $this->build_definition_data($iw->status_bitmask, [
                'type' => config('config.INDUSTRIAL_WASTE_DEFINITION')
            ]);
        }

        // Return
        return $this->true_json([
            'items' => $this->build_responses($res_industrial_waste),
            'total' => $this->count()
        ]);
    }

    /**
     * Function handle delete
     *
     * @param array $params
     */
    public function delete_rows($params = []) {
        if(empty($params)) return [];

        $this->whereIn('id', $params['id'])->delete($params);

        return $this->true_json();
    }

    /**
     * Function to download csv
     *
     * @param array $param
     * @internal param String $date_from
     * @internal param String $date_to
     *
     * @return
     */
    public function download_csv($data = [], $schema = [])
    {
        // @var Object $res_list Get list data follow condition
        $res_list = $this
            ->whereBetween('take_off_at', [
                !empty($data['date_from']) ? $data['date_from'] : '',
                !empty($data['date_to']) ? $data['date_to'] : ''
            ])
            ->get()->all();

        $res_list = $this->build_responses($res_list);

        $this->export_csv($res_list);
    }

    public function _schema() {
        return [
            'id',
            'ticket_name',
            'type',
            'take_off_at',
            'status',
            'status_bitmask',
            'client_customer_id',
            'client_location_id',
            'manifest_no',
            'manifest_issue_date',
            'quantity',
            'unit',
            'unit_price',
            'quantity_in_box',
            'quantity_total_box',
            'disposal',
            'logistic_customer_id',
            'logistic_location_id',
            'method_deliver',
            'freight_rate',
            'freight_rate_original',
            'take_off_at',
            'take_off_time',
            'car_number',
            'driver_name',
            'take_off_note',
            'installation_at',
            'box_number',
            'completed_at',
            'loading_place',
            'loading_location_remasks',
        ];
    }

    /**
     * Function build response
     */
    public function build_response($industrial_waste) {
        if(empty($industrial_waste)) {
            return;
        }

        return $this->build_response_industrial_waste($industrial_waste);
    }
}
