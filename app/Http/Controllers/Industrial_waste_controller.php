<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Response;

class Industrial_waste_controller extends AppController
{
    //
    public function index()
    {

        return view('customer.index');
    }

}
