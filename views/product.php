<?php

function estimated_delivery_product_template()
{

    echo '<style>
            .estimatedDelivery-product-root {
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
                .estimatedDelivery-product-root {
                    width: max-content;
                }
            }

            .estimatedDelivery-days-label {
                color:#77a464;
                font-weight: 500;
            }
    </style>';

    echo '<div class="estimatedDelivery-product-root">
            <span class="dashicons dashicons-clock"></span>
            <span id="estimatedDelivery-product-days"></span>'  .
        '</div>';

    echo '<script>';
    echo file_get_contents(dirname(__FILE__) . '/../assets/product.js');
    echo ' 
        (function () {
            const estimatedDelivery = getEstimatedDeliveryDisplay();
            const counterElement = document.getElementById("estimatedDelivery-product-days");
            counterElement.innerHTML = estimatedDelivery;
        })();      
    ';
    echo '</script>';
}

function estimated_delivery_single_product_summary()
{
    $enable = get_option('estimated_delivery_enable_on_product');
    if ($enable) {
        estimated_delivery_product_template();
    }
}

add_action("woocommerce_before_single_product_summary", "estimated_delivery_single_product_summary", 20, 0);
