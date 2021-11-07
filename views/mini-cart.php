<?php

function estimated_delivery_mini_cart_template()
{
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
    echo ' 
        (function() {
            const estimatedDelivery = getEstimatedDeliveryDisplay();
        })();
    ';
    echo '</script>';
}

function estimated_delivery_mini_cart_summary()
{
    estimated_delivery_mini_cart_template();
}

add_action("woocommerce_after_mini_cart", "estimated_delivery_mini_cart_summary", 20, 0);
