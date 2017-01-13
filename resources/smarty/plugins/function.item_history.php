<?php
/**
 * Smarty plugin
 */

/**
 * Smarty {item_history} function plugin
 *
 * @param $params
 *
 * @param $smarty
 * @return string
 */
function smarty_function_item_history($params, &$smarty)
{
    if (!isset($params['history']) && empty($params['history'])) return;

    $history = json_decode($params['history'], TRUE);

    // Build html of item history
    $html = '';

    if (!empty($history['message'])) {
        
        // Mapping data status to show status in time line
        if (isset($history['extra_data']['status']) && !empty($history['extra_data']['status_name'])) {
            $html .= sprintf(' <li class="time-label x-log-status"><span class="bg-green">%s</span></li>', $history['extra_data']['status_name']);
        }

        $html .= ' <li class="x-timeline-item">';
        $html .= ' <i class="fa fa-comment bg-blue"></i>';
        $html .= ' <div class="timeline-item">';

        // Mapping data date time to show in time line
        if (isset($history['create_at']) && !empty($history['create_at'])) {
            $html .= sprintf(' <span class="time x-log-time"><i class="fa fa-clock-o margin-r-5"></i>%s</span>', $history['create_at']);
        }

        // Mapping data account name to show in time line
        if (isset($history['account_name']) && !empty($history['account_name'])) {
            $html .= sprintf(' <h3 class="timeline-header x-log-header"><strong>%s</strong></h3>', $history['account_name']);
        }

        // Mapping data content of log
        $body = $history['message'] ? $history['message'] : '';

        $html .= sprintf(' <div class="timeline-body x-log-body">%s</div>', nl2br($body));
        $html .= ' </div>';
        $html .= ' </li>';
    }

    return $html;
}

