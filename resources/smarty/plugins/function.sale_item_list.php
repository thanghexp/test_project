<?php
/**
 * Smarty plugin
 */

/**
 * Smarty {sale_item_list} function plugin
 *
 * @param $params
 *
 * @param $smarty
 * @return string
 */
function smarty_function_sale_item_list($params, &$smarty)
{
    $str_sale_item = '';

    if (!empty($params['data_sale_items'])) {
        $count_sale_item = count($params['data_sale_items']);
        $data_sale_item_first = $params['data_sale_items'][0];

        if ($count_sale_item > 1) {
            $str_sale_item = sprintf('%s、他', $data_sale_item_first['product_type_name']);
        } else {
            $str_sale_item = sprintf('%s', $data_sale_item_first['product_type_name']);
        }
    }

    return $str_sale_item;
}