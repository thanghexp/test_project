<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Customer_contact extends Base_Model
{
    //
    public $primary_key = 'id';
    public $table = 'customer_contact';
    public $fillable = [
        'id',
    ];

    /**
     * Function get list data of account
     *
     * @param array $params
     *
     * @return json
     */
    public function get_list_data($params = [])
    {
        /** @var object $res_account Get list data of account */
        $res_customer_contact = $this->get()->all();

        $this->_attach_detail_customer_contact($res_customer_contact);

        return $this->true_json($this->build_responses($res_customer_contact));
    }

    /**
     * Function build response
     * @param array $data
     */
    public function build_response($data = [])
    {
        return $this->build_response_customer_contact($data);
    }
}
