<?php

function update_traditio_estimated_delivery()
{
    register_setting('traditio-estimated-delivery-settings', 'estimated_delivery_in_days');
    register_setting('traditio-estimated-delivery-settings', 'estimated_delivery_holidays');
    register_setting('traditio-estimated-delivery-settings', 'estimated_delivery_deadline_time');
}


add_action('admin_init', 'update_traditio_estimated_delivery');
