<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Master_catalog extends Base_Model
{
    //
    public $primary_key = 'id';
    public $table = 'master_catalog';

    /**
     * Get value master catalog with param
     *
     * @param array $params
     *
     * @return array
     */
    public function get_value_master_catalog($params = [])
    {
        // Load model
        $master_catalog = new \App\Master_catalog();

        $res_master_catalog = $master_catalog->get()->where('type', $params['type'])->all();

        // Return
        return $res_master_catalog;
    }

    /**
     * Function update status definition
     *
     * @param array $params
     *
     * @return true;
     */
    public function update_status_definition($params) {
        if(empty($params)) return [];

        // Load model
        $industrial_waste_model = new \App\Industrial_waste;
        $purchase_model = new \App\Industrial_waste;
        $sale_model = new \App\Industrial_waste;
        $master_catalog_model = new \App\Master_catalog();

        $model = '';

        if(empty($params['type'])) return null;

        switch($params['type']) {
            case config('config.INDUSTRIAL_WASTE_DEFINITION'): $model = $industrial_waste_model; break;
            case config('config.PURCHASE_DEFINITION'): $model = $purchase_model; break;
            case config('config.SALE_DEFINITION'): $model = $sale_model; break;
        }

        /** @var Object $res_detail Get detail $target_id of industrial_waste model */
        $res_detail = $model->find($params['target_id']);

        if(empty($res_detail)) {
            return FALSE;
        }

        $data_definition = $this->build_definition_data($res_detail['status_bitmask'], [
            'type' => $params['type']
        ]);

        // Get status_bitmask
        $status_bitmask = $res_detail->status_bitmask;

        $data_definition[$params['code']]->status = $params['status'];
        foreach($data_definition as $item) {
            $status_bitmask[($item->ordering - 1)] = $item->status;
        }

        // Update
        $industrial_waste_model->where('id', (int) $params['target_id'])->update([
            'status_bitmask' => $status_bitmask
        ]);

        return $this->true_json();
    }

    /**
     * Build response data
     *
     * @param Array $data
     *
     * @return Array
     */
    public function build_response($data) {
        return $this->build_response_master_catalog($data);
    }


}
