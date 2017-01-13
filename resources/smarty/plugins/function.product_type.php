<?php
/**
 * Smarty plugin
 */

/**
 * Smarty {product_type} function plugin
 *
 * @param $params
 *
 * @param $smarty
 * @return string
 */
function smarty_function_product_type($params, &$smarty)
{
    if (empty($params['data'])) return '';

    $data_product_type = [];
    foreach($params['data'] AS $value) {
        if (!empty($value['product_type_name'])) {
            $data_product_type[$value['product_type']] = $value['product_type_name'];
        }
    }

    return implode(', ', $data_product_type);
}