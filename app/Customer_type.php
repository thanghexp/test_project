<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Customer_type extends Base_Model
{
    //
    protected $primaryKey = 'id';
    protected $table = 'customer_type';
    protected $fillable = [
        'customer_id',
        'type'
    ];

    // Disable timestamps
    public $timestamps = false;

    /**
     * Function get info of customer type
     *
     * @param array $data
     *
     * @return array
     */
    public function get_list_data()
    {
        /** @var $res_customer_type Get list data of customer type */
        $res_customer_type = $this->get()->all();

        return $this->true_json([
            'items' => $this->build_responses($res_customer_type)
        ]);
    }

    /**
     * Function build response customer type
     */
    public function build_response($data, $option = [])
    {
        return $this->build_response_customer_type($data);
    }

}
