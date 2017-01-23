<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Master_catalog extends Base_Model
{
    //
    public $primary_key = 'id';
    public $table = 'master_catalog';

    public function get_value_master_catalog($params = [])
    {
        // Load model
        $master_catalog = new \App\Master_catalog();

        $res_master_catalog = $master_catalog->get()->where('type', $params['type'])->all();

        $data_master_catalog = [];
        foreach($res_master_catalog AS $master_catalog) {
            $data_master_catalog[$master_catalog->type] = $master_catalog->value;
        }

        // Return
        return $this->true_json(
            $this->build_responses($res_master_catalog)
        );
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
