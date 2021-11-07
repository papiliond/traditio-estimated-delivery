<?php

include(dirname(__FILE__) . '/../utils/get-estimated-delivery.php');

function estimated_delivery_product_template($days)
{
    $deliveryInDays = get_option('estimated_delivery_in_days');
    $deadlineTime = get_option('estimated_delivery_deadline_time');
    $holidays = explode("\n", get_option('estimated_delivery_holidays'));

    echo '<style>
        .estimatedDelivery-root {
            font-weight: 500;
            line-height: 1.5;
            background: white;
        width: max-content;
            padding: 0.5rem 0.5rem 0.5rem;
            margin-bottom: 1rem;
            border-left: 4px solid #000;
            border-radius: 2px 5px 5px 2px;
            box-shadow: 1px 2px 6px 0px rgb(0 0 0 / 15%);
        }

        .estimatedDelivery-days-label {
            color:#77a464;
            font-weight: 500;
        }
    </style>';

    echo '<div class="estimatedDelivery-root">
            <span class="dashicons dashicons-clock"></span>
            <span id="estimatedDelivery-days"></span>'  .
        '</div>';

    echo '<script>';
    echo file_get_contents(dirname(__FILE__) . '/../assets/utils.js');
    echo file_get_contents(dirname(__FILE__) . '/display.js');
    echo ' 
        const estimatedDelivery = getEstimatedDeliveryDisplay(' . json_encode($deliveryInDays) . ',' . json_encode($deadlineTime) . ',' . json_encode($holidays) . ');
        const counterElement = document.getElementById("estimatedDelivery-days");
        counterElement.innerHTML = estimatedDelivery;
    ';
    echo '</script>';
}

function estimated_delivery_single_product_summary()
{
    $estimatedDeliveryInDays = get_estimated_delivery();
    estimated_delivery_product_template($estimatedDeliveryInDays);
}

add_action("woocommerce_before_single_product_summary", "estimated_delivery_single_product_summary", 20, 0);
