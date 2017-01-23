<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Account extends Base_Model
{
    //
    public $primaryKey = 'id';
    public $table = 'account';

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
        $res_account = $this->get()->all();

        $this->_attach_detail_account($res_account);

        return $this->true_json($this->build_responses($res_account));
    }

    /**
     * Build responses
     */
    public function build_response($data) {
        return $this->build_response_account($data);
    }
}
