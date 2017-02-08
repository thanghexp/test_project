<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Industrial_waste extends Base_Model
{
    //
    public $table = 'industrial_waste';
    public $primaryKey = 'id';
    public $fillable = [
    	'id',
    	'ticket_name'
    ];

    /**
     * Function get list data of customer
     *
     * @param array $params
     * @param internal integer $offset
     * @param internal integer $limit
     *
     * @return json
     */
    public function get_list_data($params = [])
    {
        /** @var Object $res_customer Get list customer  */
        $res_industrial_waste = $this->get_list($params);

        // Attach detail industrial waste
        $this->_attach_detail_industrial_waste($res_industrial_waste);

        foreach($res_industrial_waste as $iw) {
            $res_industrial_waste[$iw->id]->definition_data = $this->_attach_status_definition($iw->status_bitmask, [
                'type' => config('config.INDUSTRIAL_WASTE_TYPE')
            ]);
        }

        // Return
        return $this->true_json([
            'items' => $this->build_responses($res_industrial_waste),
            'total' => $this->count()
        ]);
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
