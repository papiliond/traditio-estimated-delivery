<?php

function estimated_delivery_head_content()
{
    $utils =  file_get_contents(dirname(__FILE__) . '/../assets/utils.js');
    $display = file_get_contents(dirname(__FILE__) . '/../assets/display.js');

    $deliveryInDays = get_option('estimated_delivery_in_days');
    $deadlineTime = get_option('estimated_delivery_deadline_time');
    $holidays = explode("\n", get_option('estimated_delivery_holidays'));

?>
    <script>
        <?php echo $utils; ?>
        <?php echo $display; ?>

        window.__ESTIMATED_DEADLINE_TIME__ = <?php echo json_encode($deadlineTime); ?>;
        window.__ESTIMATED_DELIVERY__ = getEstimatedDelivery(<?php echo json_encode($deliveryInDays) . ',' . json_encode($deadlineTime) . ',' . json_encode($holidays); ?>);
    </script>
<?php
}

add_action('wp_head', 'estimated_delivery_head_content');
