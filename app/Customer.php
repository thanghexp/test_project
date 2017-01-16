<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Customer extends Model
{
    //
    public $primary_key = 'id';
    public $table = 'customer';

    public function rules(\Illuminate\Http\Request $request) {
        return [
            'customer_name' => 'required',
            'status' => 'required|exist_customer_type',
        ];
    }

}
