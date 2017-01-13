<?php
/**
 * Smarty plugin
 */

/**
 * Smarty {sale_information} function plugin
 *
 * @param $params
 *
 * @param $smarty
 * @return string
 */
function smarty_function_sale_information($params, &$smarty)
{
    $str_sale_info = '';

    if (isset($params['data_sale']) && !empty($params['data_sale']) && isset($params['data_sale']['sale_items'])
        && !empty($params['data_sale']['sale_items'])) {

        $data_sales = [];
        foreach ($params['data_sale']['sale_items'] AS $sale_item) {
            $item_sale = [];

            if (isset($sale_item['product_type_name']) && !empty($sale_item['product_type_name'])) {
                $item_sale[] = $sale_item['product_type_name'];
            }

            if (isset($sale_item['purchase_quantity']) && !empty($sale_item['purchase_quantity'])) {
                $unit = !empty($sale_item['purchase_quantity_name']) ? $sale_item['purchase_quantity_name'] : '';
                $item_sale[] = $sale_item['purchase_quantity'].$unit;
            }

            if (isset($sale_item['sale_price']) && !empty($sale_item['sale_price'])) {
                $item_sale[] = $sale_item['sale_price'].'円';
            }

            $data_sales[] = implode('/', $item_sale);
        }

        $str_sale_info = implode(', ', $data_sales);
    }

    return $str_sale_info;
}

