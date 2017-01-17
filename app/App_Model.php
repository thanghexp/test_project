<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class App_Model extends Model
{
    //
    protected $primaryKey = '';
    protected $table = '';

    /** Construct */
    public function __construct() {
    	parent::__construct();
    }

    /**
	 * Function common 
	 * @param array $params
     * @internal
	 * 
	 * @return;
     */
    public function get_list($params = []) 
    {
    	$db = $this;
    	// Condition to SELECT 
    	if(isset($params['select']) !empty(&& $params['select'])) {
    		$db = $this->select($params['select']);
    	}

    	// Condition to JOIN TABLE 
    	if(isset($params['join_table']) && is_array($params['join_table']) ) {
    		foreach($params['join_table'] AS $table_join => $condition_combine) {
    			$db = $this->join($table_join)
				 	->on($condition_combine);
    		}
    	}

		// Condition to AND WHERE       	
    	if(isset($params['where']) && is_array($params['where'])) {
    		foreach($params['where'] AS $field => $value) {
    			$db = $this->where($field, $value);		
    		}
    	}

    	// Condition to OR WHERE
    	if(isset($params['or_where']) && is_array($params['or_where'])) {
    		foreach($params['or_where'] AS $field => $value) {
    			$db = $this->orWhere($field, $value);	
    		} 
    	}

    	// Condition to IN WHERE
    	if(isset($params['in_where']) && is_array($params['in_where'])) {
    		foreach($params['in_where'] AS $field => $value ) {
    			$db = $this->whereIn($field, $value);
    		}
    	}

    	// Condition to NOT IN WHERE
    	if(isset($params['not_in_where']) && is_array($params['not_in_where'])) {
    		foreach($params['not_in_where'] AS $field => $value ) {
    			$db = $this->whereNotIn($field, $value);
    		}
    	}

    	// Condition to OFFSET 
    	if(isset($params['offset']) && !empty($params['offset'])) {
    		$db = $this->skip($params['offset']);
    	}

    	// Condition to LIMIT
    	if(isset($params['limit']) && !empty($params['limit'])) {
    		$db = $this->take($params['limit']);
    	}

    	// Condition to ORDER_BY
    	if( (isset($params['order_by']) && is_array($params['order_by'])) ) {
    		foreach($params['order_by'] AS $field => $value) {
    			$db = $this->orderBy($field, $value);	
    		}
    	}

    	// Condition to GROUP_BY
    	if( (isset($params['group_by'])) && !empty($params['group_by'])) {
    		$db = $this->groupBy($params['group_by']);
    	}

    	return $db->get();
    }

    /**
  	 * Function get detail 
     */
    public function get_detail($params[])
    {
    	if(!empty($params['where']) && is_array($params['where']) {

    	}
    }

    /**
	 * Function insert record 
     */
    public function save($data, $flash) 
    {

    }

}
