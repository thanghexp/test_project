<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Response;


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
	 *
	 * @param array $params
     * @internal param string $select
	 * @internal param array $join_table
	 * @internal param array $where
	 * @internal param array $or_where
	 * @internal param array $in_where
	 * @internal param array $not_in_where
	 * @internal param array $offset
	 * @internal param array $limit
	 * @internal param array $order_by
	 * @internal param array $group_by
	 *
	 * @return object
     */
    public function get_list($params = []) 
    {
		$target = $this;
    	// Condition to SELECT
    	if(isset($params['select']) && is_array($params['select'])) {
			$target = $target->select($params['select']);
    	}

    	// Condition to JOIN TABLE 
    	if(isset($params['join_table']) && is_array($params['join_table'])) {
    		foreach($params['join_table'] AS $table_join => $condition_combine) {
				$target = $target->join($table_join)
				 	->on($condition_combine);
    		}
    	}

		// Condition to AND WHERE       	
    	if(isset($params['where']) && is_array($params['where'])) {
    		foreach($params['where'] AS $field => $value) {
				$target = $target->where($field, $value);
    		}
    	}

    	// Condition to OR WHERE
    	if(isset($params['or_where']) && is_array($params['or_where'])) {
    		foreach($params['or_where'] AS $field => $value) {
				$target = $target->orWhere($field, $value);
    		} 
    	}

    	// Condition to IN WHERE
    	if(isset($params['in_where']) && is_array($params['in_where'])) {
    		foreach($params['in_where'] AS $field => $value ) {
				$target = $target->whereIn($field, $value);
    		}
    	}

    	// Condition to NOT IN WHERE
    	if(isset($params['not_in_where']) && is_array($params['not_in_where'])) {
    		foreach($params['not_in_where'] AS $field => $value ) {
				$target = $target->whereNotIn($field, $value);
    		}
    	}

    	// Condition to OFFSET 
    	if(isset($params['offset']) && !empty($params['offset'])) {
			$target = $target->skip($params['offset']);
    	}

    	// Condition to LIMIT
    	if(isset($params['limit']) && !empty($params['limit'])) {
			$target = $target->take($params['limit']);
    	}

    	// Condition to ORDER_BY
    	if( (isset($params['order_by']) && is_array($params['order_by'])) ) {
    		foreach($params['order_by'] AS $field => $value) {
				$target = $target->orderBy($field, $value);
    		}
    	}

    	// Condition to GROUP_BY
    	if( (isset($params['group_by'])) && !empty($params['group_by'])) {
			$target = $target->groupBy($params['group_by']);
    	}

    	return $target->get();
    }

    /**
  	 * Function get detail
	 *
	 * @params array $params
	 * @internal Array $where
	 *
	 * return Object
     */
    public function get_detail($params = [])
    {
		// Condition to WHERE
    	if(isset($params['where']) && is_array($params['where'])) {
			foreach($params['where'] AS $field => $value) {
				$target = $this->where($field, $value);
			}
    	}

		// Return Object
		return $target->first();

    }

    /**
	 * Function insert or update record
	 *
	 * @param array $data
	 * @param array $option
	 *
	 * @return integer
     */
    public function save_data($data, $option = [])
    {
		if(!is_array($data)) {
			return FALSE;
		}

		$target = $this;

		// Update data
		if(isset($option['where']) && is_array($option['where'])) {
			foreach($option['where'] AS $field => $value) {
				$target->where($field, $value);
			}
			$target->update($data);
		}
		// Insert data
		else {
			if($option['type'] == TRUE) {
				return $this->saveMany($data);
			} else {
				$res = $this->save($data);
				return $res->id;
			}
		}
    }

	/**
	 * Function response data success
	 *
	 * @param array $data
	 * @param mixed $option
	 *
	 * @return
	 */
	public function true_json($data, $option = [])
	{
		$option = array_merge([
			'status' => FALSE,
			'submit' => TRUE,
		], $option);

		if(is_array($data)) {
			$option['items'] = $data;
		}

		return Response()->json($option, 200);
	}

	/**
	 * Function response data success
	 *
	 * @param Array $errmsg
	 * @param mixed $option
	 *
	 * @return
	 */
	public function false_json($errmsg, $option = [])
	{
		$option = array_merge([
			'status' => isset($option['status']) ? $option['status'] : 404,
			'submit' => FALSE,
			'header' => isset($option['header']) ? $option['header'] : 'Application/json',
			'message' => $errmsg
		], $option);

		return Response()->json($option, 200);
	}

	/**
	 * Function build responses to array
	 *
	 * @param array $data
	 * @param mixed $option
	 *
	 * @return array
	 */
	public function build_responses($data, $option = [])
	{
		if(!is_array($data)) {
			return [];
		}

		$res = [];
		foreach($data as $key => $value) {
			$res[$key] = $this->build_response($value);
		}

		return $res;
	}



}
