<?php
/**
 * Smarty plugin
 */

/**
 * Smarty {customer_contact} function plugin
 *
 * @param $params
 * @internal param string $name Name contact customer
 * @internal param string $contact Contact customer (phone, mobile, sms, email)
 *
 * @param $smarty
 * @return string
 */
function smarty_function_customer_contact($params, &$smarty)
{
    // Build string
    $string_name = isset($params['name']) && !empty($params['name']) ? $params['name'] : '';
    $string_contact = isset($params['contact']) && !empty($params['contact']) ? sprintf('(%s)', $params['contact']) : '';

    return sprintf('%s %s', $string_name, $string_contact);
}

