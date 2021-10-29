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
            <tr valign="top">
                <th scope="row">Holidays: </br> (1 column CSV)</th>
                <td><textarea id="estimated_delivery_holidays" name="estimated_delivery_holidays" rows="15" cols="75"><?php echo get_option('estimated_delivery_holidays'); ?></textarea></td>
            </tr>
        </table>
        <?php submit_button(); ?>
    </form>

    <script>
        const textareaInput = document.getElementById('estimated_delivery_holidays');

        textareaInput.onpaste = e => {
            const textContent = e.clipboardData.getData('text');
            e.target.value = textContent.split(/\n/).filter(str => str).map(str => {
                const date = new Date(str);
                let result;
                console.log({
                    str,
                    date
                })
                if (isNaN(date.getTime())) {
                    return "invalid";
                }

                // Format to 00/00/00
                return Intl.DateTimeFormat("en-US", {
                    day: "2-digit",
                    month: "2-digit",
                    year: "2-digit"
                }).format(date)
            }).join("\n");
            e.preventDefault();
        }

        // Allow paste only
        textareaInput.onkeydown = e => {
            var ctrl = e.ctrlKey ? e.ctrlKey : ((e.keyCode === 17) ? true : false);
            if (e.keyCode === 86 && ctrl || e.keyCode === 67 && ctrl || e.keyCode === 88 && ctrl) {
                return true;
            } else {
                return false;
            }
        }

        textareaInput.onchange = e => {
            if (!/([0-9]{2}\/[0-9]{2}\/[0-9]{2})\n?/.test(e.target.value)) {
                e.target.value = "invalid";
                e.preventDefault();
            }
        }
    </script>
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
