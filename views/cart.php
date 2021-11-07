<?php

function estimated_delivery_mini_cart_template()
{
    echo '<style>
        .estimatedDelivery-cart-root {
            font-weight: 500;
            line-height: 1.5;
            background: white;
            padding: 0.5rem 0.5rem 0.5rem;
            margin-bottom: 1rem;
            border-left: 4px solid #000;
            border-radius: 2px 5px 5px 2px;
            box-shadow: 1px 2px 6px 0px rgb(0 0 0 / 15%);
        }

        @media (min-width: 481px) {
            .estimatedDelivery-cart-root {
                width: max-content;
            }
        }

        .estimatedDelivery-days-label {
            color:#77a464;
            font-weight: 500;
        }
    </style>';

    echo '<div class="estimatedDelivery-cart-root">
            <span class="dashicons dashicons-clock"></span>
            <span id="estimatedDelivery-cart-days"></span>'  .
        '</div>';

    echo '<script>';
    echo file_get_contents(dirname(__FILE__) . '/../assets/cart.js');
    echo ' 
        (function() {
            const estimatedDelivery = getEstimatedDeliveryDisplay();
            const counterElement = document.getElementById("estimatedDelivery-cart-days");
            counterElement.innerHTML = estimatedDelivery;
        })();
    ';
    echo '</script>';
}

function estimated_delivery_cart_summary()
{
    estimated_delivery_mini_cart_template();
}

add_action("woocommerce_before_cart", "estimated_delivery_cart_summary", 10, 0);
