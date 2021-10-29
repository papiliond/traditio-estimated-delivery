<?php

function traditio_page()
{
?>
    <h1>Estimated Delivery Settings</h1>
    <form method="post" action="options.php">
        <?php settings_fields('traditio-estimated-delivery-settings'); ?>
        <?php do_settings_sections('traditio-estimated-delivery-settings'); ?>
        <table class="form-table">
            <tr valign="top">
                <th scope="row">Days:</th>
                <td><input type="number" name="estimated_delivery_in_days" value="<?php echo get_option('estimated_delivery_in_days'); ?>" /></td>
            </tr>
        </table>
        <?php submit_button(); ?>
    </form>
<?php
}

function estimated_delivery_info_menu()
{
    $page_title = 'Estimated delivery - Traditio';
    $menu_title = 'Estimated delivery';
    $capability = 'manage_options';
    $menu_slug  = 'traditio-estimated-delivery';
    $function   = 'traditio_page';

    add_submenu_page('woocommerce', $page_title, $menu_title, $capability, $menu_slug, $function);
}

add_action('admin_menu', 'estimated_delivery_info_menu');
