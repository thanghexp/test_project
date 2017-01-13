<?php
/**
 * Smarty plugin
 */

/**
 * Smarty {status_completion_delivery} function plugin
 *
 * @param $params
 *
 * @param $smarty
 * @return string
 */
function smarty_function_status_completion_delivery($params, &$smarty)
{
    $status = '未完了';
    if (!empty($params['status']) && $params['status'] == 1) $status = '完了';
    if (!empty($params['status']) && $params['status'] == 3) $status = '完了（問題有）';

    return $status;
}