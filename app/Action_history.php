<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Action_history extends Base_Model
{
    //
    protected $primaryKey = 'customer_id';
    protected $table = 'action_history';
    protected $fillable = [
        'account_id',
        'target_id',
        'action',
        'extra_data',
        'object',
        'created_at',
        'updated_at',
        'created_by',
        'updated_by'
    ];
}
