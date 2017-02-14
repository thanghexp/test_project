<?php

namespace App\Http\Controllers\api;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\App;
use Excel;

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
}
