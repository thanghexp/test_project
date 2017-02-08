<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Response;

class Industrial_waste_controller extends AppController
{
    //
    public function index(Request $request)
    {
    	$params = $request->all();

		$data['list_detail_page'] = isset($params['view']) ? TRUE : FALSE;
		$page = isset($params['page']) ? $params['page'] : 1;

    	// Load model
    	$industrial_waste_model = new \App\Industrial_waste;

    	// Set offset and limit
    	$params = $this->_params();

    	// @var object $res_iw Get list industrial waste from model 
    	$res_iw = $industrial_waste_model->get_list_data($params)->getData(TRUE);

        $total = !empty($res_iw['data']['total']) ? (int) $res_iw['data']['total'] : null;

        $data['industrial_wastes'] = $res_iw['data']['items'];

		foreach($data['industrial_wastes'] as $iw)
		dd($iw['definition_data']);

		$data['pagination'] = [
			'total' => (int) $total,
			'per_page' => ($total > $params) ? ($total % $params['limit'])  : 1,
			'current_page' =>  $page,
			'prev_page' =>  $page != 1 ? '?page=' . ($page - 1) : null,
			'next_page' =>   $page != ($total % $params['limit']) ? '?page=' . ($page + 1) : null,
		];
    	// Handle order and search 

    	$data['title'] = 'Industrial waste';


//		dd($data);

        return view('industrial_waste.index', $data);
    }

}
