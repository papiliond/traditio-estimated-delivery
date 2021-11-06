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
                width: 360px;
                padding: 0.5rem 0.5rem 0.5rem;
                margin-bottom: 1rem;
                border-left: 4px solid #000;
                border-radius: 2px 5px 5px 2px;
                box-shadow: 1px 2px 6px 0px rgb(0 0 0 / 15%);
            }

            .estimatedDelivery-days {
                color:#77a464;
                font-weight: 500;
            }
        </style>';

        echo '<div class="estimatedDelivery-root">
                <span class="dashicons dashicons-clock"></span>' .
            ' Szállítás várható időtartama: ' . '<span class="estimatedDelivery-days">' . '<span id="estimatedDelivery-counter"></span>' . ' nap' . '</span>' .
            '</div>';

        echo '<script>' . file_get_contents(dirname(__FILE__) . '/../utils/getEstimatedDelivery.js') . '</script>';
        echo '<script> 
            
            const estimatedDelivery = getEstimatedDelivery(' . json_encode($deliveryInDays) . ',' . json_encode($deadlineTime) . ',' . json_encode($holidays) . ');
            const counterElement = document.getElementById("estimatedDelivery-counter");
            counterElement.innerText = estimatedDelivery;
 
         </script>';
    }

    function estimated_delivery_single_product_summary()
    {
        $estimatedDeliveryInDays = get_estimated_delivery();
        estimated_delivery_product_template($estimatedDeliveryInDays);
    }

    add_action("woocommerce_before_single_product_summary", "estimated_delivery_single_product_summary", 20, 0);
