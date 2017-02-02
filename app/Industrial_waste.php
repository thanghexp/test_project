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
    public function get_data($params = [])
    {
        /** @var Object $res_customer Get list customer  */
        $res_iw = $this->get_list($params);

        // Attach detail industrial waste
        $this->_attach_iw_detail($res_iw);

        // Return
        return $this->true_json([
            'items' => $res_iw,
            'total' => $this->count()
        ]);
    }
}
