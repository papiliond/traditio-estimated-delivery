<?php

/**
 * Plugin Name: Traditio Estimated Delivery
 * Description: Plugin to set estimated delivery
 * Version: 1.0
 * Author: Daniel Papilion
 */

if (!defined("ABSPATH")) {
    exit; // Exit if accessed directly
}

include(dirname(__FILE__) . '/install.php');
include(dirname(__FILE__) . '/settings.php');
include(dirname(__FILE__) . '/admin-page.php');

include(dirname(__FILE__) . '/asset.php');

include(dirname(__FILE__) . '/views/product.php');