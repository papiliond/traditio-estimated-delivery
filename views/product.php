    <?php

    function estimated_delivery_product_template($days)
    {
        echo '<style>
            .estimatedDelivery-root {
                font-weight: 500;
                line-height: 1.5;
                background: white;
                width: 320px;
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
            ' Szállítás várható ideje: '.'<span class="estimatedDelivery-days">'. $days .' nap'.'</span>' .
            '</div>';
    }

    function estimated_delivery_single_product_summary()
    {
        $estimatedDeliveryInDays = get_option('estimated_delivery_in_days');
        echo estimated_delivery_product_template($estimatedDeliveryInDays);
    }

    add_action("woocommerce_before_single_product_summary", "estimated_delivery_single_product_summary", 20, 0);
