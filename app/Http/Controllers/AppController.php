<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;


class AppController extends BaseController
{
    /**
     * Template layout
     */
    public $layout = '';

    // Construct
    public function __construct()
    {
        //$this->smarty = new \Smarty();
    }

    /**
     * Setting limit and offset
     */
    public function _params($offset = 10, $limit = 0)
    {

    }

    /**
     * Build JSON fail
     *
     * @param string $errmsg
     * @param array $option
     *
     * return json
     */
    public function _false_json($errmsg = NULL, $option = array())
    {
        $option = $this->_build_json($errmsg, $option);
        return Response()->json($option);
    }

    /**
     * Build JSON success
     *
     * @param array $data
     * @param array $extra
     * @param array $option
     */
    public function _true_json($errmsg = NULL, $option = array())
    {
        $option = $this->_build_json($errmsg, $option);
        return Response()->json($option, 200);
    }

    /**
     * Build data json
     *
     * @param mixed $data
     * @param array $option
     *
     * return
     */
    public function _build_json($data = NULL, $option = array())
    {
        $option = array_merge([
            'header' => TRUE,
            'status' => 200,
            'submit' => FALSE
        ], $option);

        // Set content type header for response
        if($option['header']) {
            $option['header'] = 'application/json';
        }

        if($option['submit'] == FALSE) {
            $option['message'] = $data;
        } else {
            $option['content'] = $data;
        }

        return $option;
    }


    /**
     * Render to links contain template layout
     *
     * @param string $template
     * @param array $data
     */
    public function _render($template = '', $data = [])
    {
        $app_name = config('constant.APP_NAME');
        $data['title'] = !empty($app_name) ? $app_name : '';

        if(isset($data['title'])) {
            $data['title'] = $data['title'] . ' | ' . $app_name;
        }

        return view($template, $data);
    }

}
