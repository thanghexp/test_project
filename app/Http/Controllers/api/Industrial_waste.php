<?php

namespace App\Http\Controllers\api;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\App;
use Excel;
use Barryvdh\DomPDF\PDF;

class Industrial_waste extends Controller
{
    /** Function to delete iw with one or many
      *
      * @params Object Request
      *
      * @return Response
      */
    public function delete(Request $request) {
        // Load model
        $industrial_waste_model = new \App\Industrial_waste();

        // Return
        return $industrial_waste_model->delete_rows($request->all());
    }

    /**
     * Function to check validation
     *
     * @param \App\Http\Request
     *
     * @return
     */
    public function validation_csv(Request $request) {
        return [
            'submit' => TRUE,
            'success' => TRUE
        ];
    }

    /**
     * Function to call download csv
     *
     * @param \App\Http\Request
     *
     * @return
     */
    public function csv(Request $request) {
        // Load model
        $industrial_waste_model = new \App\Industrial_waste();

        return $industrial_waste_model->download_csv($request->all());
    }

    /**
     * Function to handle model contact detail
     */
    public function handle_contact_detail(Request $request) {
        $params = $request->all();

        if(empty($params)) return;

        // Load model
        $industrial_waste_model = new \App\Industrial_waste();

        switch($params['method']) {
            case 'pdf': return $industrial_waste_model->export_pdf($params); break;
            case 'email': $industrial_waste_model->export_email($params); break;
            case 'fax': $industrial_waste_model->export_fax($params); break;
        }

    }

}
