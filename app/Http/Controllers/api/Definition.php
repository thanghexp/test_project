<?php

namespace App\Http\Controllers\api;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class Definition extends Controller
{
    /**
     * Update status of data definition
     */
    public function change_status(Request $request)
    {
        // Load model
        $master_catalog_model = new \App\Master_catalog();

        return $master_catalog_model->update_status_definition($request->all());
    }
}
