<?php

function traditio_page()
{
?>
    <h1>Szállítási határidő</h1>
    <form method="post" action="options.php">
        <?php settings_fields('traditio-estimated-delivery-settings'); ?>
        <?php do_settings_sections('traditio-estimated-delivery-settings'); ?>
        <table class="form-table">
            <tr valign="top">
                <th scope="row">Szállítás ideje (munkanap)</th>
                <td><input type="number" name="estimated_delivery_in_days" value="<?php echo get_option('estimated_delivery_in_days'); ?>" /></td>
            <tr valign="top">
                <th scope="row">Szállítás X óráig</th>
                <td><input type="text" id="estimated_delivery_deadline_time" name="estimated_delivery_deadline_time" value="<?php echo get_option('estimated_delivery_deadline_time'); ?>" /></td>
            </tr>
            </tr>
            <tr valign="top">
                <th scope="row">Ünnapnapok: </br> (egyenként új sorban)</th>
                <td><textarea id="estimated_delivery_holidays" name="estimated_delivery_holidays" rows="15" cols="75"><?php echo get_option('estimated_delivery_holidays'); ?></textarea></td>
            </tr>
        </table>
        <?php submit_button(null, null, null, null, "id='estimated_delivery_submit_button'"); ?>
    </form>

    <script>
        const holidaysTextArea = document.getElementById('estimated_delivery_holidays');
        const submitButton = document.getElementById('estimated_delivery_submit_button');

        holidaysTextArea.onpaste = e => {
            const textContent = e.clipboardData.getData('text');
            e.target.value = textContent.split(/\n/).filter(str => str).map(str => {
                const date = new Date(str);
                let result;

                if (isNaN(date.getTime())) {
                    // This is going to be cached by onchange
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

        holidaysTextArea.onchange = e => {
            const values = e.target.value ? e.target.value.split("\n") : [];
            if (values.some(value => !/^[0-9]{2}\/[0-9]{2}\/[0-9]{2}$\n?/.test(value))) {
                submitButton.setAttribute('disabled', true)
            } else {
                submitButton.removeAttribute('disabled');
            }
        }

        const deadlineInput = document.getElementById('estimated_delivery_deadline_time');
        deadlineInput.onchange = e => {
            if (!/^[0-9]{2}:[0-9]{2}$/.test(e.target.value)) {
                submitButton.setAttribute('disabled', true)
            } else {
                submitButton.removeAttribute('disabled');
            }
        }
    </script>
<?php
}

function estimated_delivery_info_menu()
{
    $page_title = 'Szállítási határidő';
    $menu_title = 'Szállítási határidő';
    $capability = 'manage_options';
    $menu_slug  = 'traditio-estimated-delivery';
    $function   = 'traditio_page';

    add_submenu_page('woocommerce', $page_title, $menu_title, $capability, $menu_slug, $function);
}

add_action('admin_menu', 'estimated_delivery_info_menu');
