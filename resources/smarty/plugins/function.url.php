<?php
/**
 * Smarty plugin
 */

/**
 * Smarty {url} function plugin
 *
 * Type function
 * Name url
 * @author Yoshikazu Ozawa
 * @mail: ozawa@interest-marketing.net
 */
function smarty_function_url($params, &$smarty)
{

    $route = $params['route'];
    unset($params['route']);

    return route($route, $params);
}

