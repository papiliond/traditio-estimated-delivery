<?php

function update_traditio_estimated_delivery()
{
    register_setting('traditio-estimated-delivery-settings', 'estimated_delivery_in_days');
}


add_action('admin_init', 'update_traditio_estimated_delivery');
