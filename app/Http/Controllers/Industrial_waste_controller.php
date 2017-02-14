<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Response;
use Excel;

class Industrial_waste_controller extends AppController
{
    //
    public function index(Request $request)
    {
    	$params = $request->all();

		$data['list_detail_page'] = isset($params['view']) ? TRUE : FALSE;
		$page = isset($params['page']) ? $params['page'] : 1;

    	// Load model
    	$industrial_waste_model = new \App\Industrial_waste();
		$master_catalog_model = new \App\Master_catalog();

    	// Set offset and limit
    	$params = $this->_params();

    	// @var object $res_iw Get list industrial waste from model 
    	$res_iw = $industrial_waste_model->get_list_data($params)->getData(TRUE);

        $total = !empty($res_iw['data']['total']) ? (int) $res_iw['data']['total'] : null;

        $data['industrial_wastes'] = $res_iw['data']['items'];

		// Set pagination to view
		$data['pagination'] = [
			'total' => (int) $total,
			'per_page' => ($total > $params['limit']) ? ($total / $params['limit'])  : 1,
			'current_page' =>  $page,
			'prev_page' =>  $page != 1 ? '?page=' . ($page - 1) : null,
			'next_page' =>   $page != ((int) ($total / $params['limit'])) ? '?page=' . ($page + 1) : null,
			'from' => ($page - 1) * $params['limit'],
			'to' => $page * $params['limit']
		];

    	// Handle order and search
    	$data['title'] = 'Industrial waste';
		$data['page'] = 'industrial_waste';
		$data['industrial_waste_types'] = $master_catalog_model->get_value_master_catalog([
			'type' => config('config.INDUSTRIAL_WASTE_TYPE')
		]);
		$data['search_field'] = !empty($params['search_field']) ? $params['search_field'] : null;
		$data['search_value'] = !empty($params['search_value']) ? $params['search_value'] : null;
		$data['order'] = !empty($params['order']) ? $params['sort'] : null;
		$data['sort'] = !empty($params['sort']) ? $params['sort'] : null;
		$data['view'] = !empty($params['view']) ? $params['view'] : null;

        return view('industrial_waste.index', $data);
    }

	/**
	 * Function to register industrial waste
	 *
	 * @param \App\Httt\Request
	 *
	 * @return Array
	 */
	public function create() {
		// Load model
		$master_catalog_model = new \App\Master_catalog();
		$customer_model = new \App\Customer();
		$customer_location_model = new \App\Customer_location();

		$data['industrial_waste_type'] = $master_catalog_model->get_value_master_catalog([
			'type' => config('config.INDSUTRIAL_WASTE_TYPE')
		]);

		$data['industrial_waste_status'] = $master_catalog_model->get_value_master_catalog([
			'type' => config('config.INDSUTRIAL_WASTE_STATUS')
		]);

		$data['industrial_waste_method_disposal'] = $master_catalog_model->get_value_master_catalog([
			'type' => config('config.INDUSTRIAL_WASTE_METHOD_DISPOSAL')
		]);

		$data['industrial_waste_unit'] = $master_catalog_model->get_value_master_catalog([
			'type' => config('config.INDUSTRIAL_WASTE_UNIT')
		]);

		$client_customer_bussiness = $customer_model->get_list_data()->getData(TRUE);
		$client_customer_location = $customer_location_model->get_list_data();

		$data['client_customer_business'] = !empty($client_customer_business) ? $client_customer_bussiness['data']['items'] : '';
		$data['client_customer_location'] = !empty($client_customer_location) ? $client_customer_location : '';

		$data['logistic_customer_business'] = !empty($client_customer_business) ? $client_customer_bussiness['data']['items'] : '';
		$data['logistic_customer_business'] = $customer_model->get_list_data();

		$data['title'] = 'Create/Update Industrial Waste';
		$data['page'] = 'Create/Update industrial_waste';

		return view('industrial_waste.create', $data);
	}

}
