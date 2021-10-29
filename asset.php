    <?php

    function wpb_hook_javascript()
    {

        $extra_info = get_option('estimated_delivery_in_days');

    ?>
        <script>
            const element = document.createElement('div');
            element.textContent = <?php echo get_option('estimated_delivery_in_days'); ?>;

            window.onload = () => document.title = <?php echo get_option('estimated_delivery_in_days'); ?>;
        </script>
    <?php
    }

    add_action('wp_head', 'wpb_hook_javascript');
