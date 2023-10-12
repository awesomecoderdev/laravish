<?php
function global_notice_meta_box()
{

    add_meta_box(
        '_slider',
        __('Slider', 'sitepoint'),
        '_the_slider_meta_box_callback',
        'post',
        "side"
        // 'normal',
        // 'default'
    );
}

add_action('add_meta_boxes', 'global_notice_meta_box');

if (!function_exists("_the_slider_meta_box_callback")) {
    function _the_slider_meta_box_callback($post)
    {
        $slider = get_post_meta($post->ID, "_slider", true);
        $slider_title = get_post_meta($post->ID, "_slider_title", true);
        $slider_button = get_post_meta($post->ID, "_slider_button", true);
        $slider_link = get_post_meta($post->ID, "_slider_link", true);

        ob_start();
?>
        <div class="">
            <div>
                <label>
                    <input type="radio" value="on" <?php echo $slider == "on" ? "checked" : "" ?> name="_slider" id="_slider" value=""> <?php _e("Enable") ?>
                </label>
                <label>
                    <input type="radio" value="off" <?php echo $slider == "off" ? "checked" : "" ?> <?php echo $slider == "" ? "checked" : "" ?> name="_slider" id="_slider"> <?php _e("Disable") ?>
                </label>
            </div>
            <br>
            <input type="text" class="components-form-token-field__input-container components-textarea-control__input" value="<?php echo $slider_title != "" ? $slider_title : $post?->post_title ?>" name="_slider_title" placeholder="<?php _e("Slider Title") ?>">
            <input type="text" class="components-form-token-field__input-container components-textarea-control__input" value="<?php echo $slider_button != "" ? $slider_button : __("Get Now") ?>" name="_slider_button" placeholder="<?php _e("Slider Button") ?>">
            <input type="text" class="components-form-token-field__input-container components-textarea-control__input" value="<?php echo $slider_link != "" ? $slider_link : site_url("/") ?>" name="_slider_link" placeholder="<?php _e("Slider Link") ?>">
        </div>
<?php
        $output = ob_get_contents();
        ob_end_clean();

        echo $output;
    }
}

/**
 * Save meta box content.
 *
 * @param int $post_id Post ID
 */
add_action('save_post', '_slider_save_meta_box');
if (!function_exists("_slider_save_meta_box")) {
    function _slider_save_meta_box($post_id)
    {
        if (isset($_POST["_slider"])) {
            $slider = $_POST["_slider"];
            $slider = in_array($slider, ["on", "off"]) ? strtolower($slider) : "off";
            update_post_meta($post_id, "_slider", $slider);
        }

        if (isset($_POST["_slider_title"])) {
            $slider_title = $_POST["_slider_title"];
            update_post_meta($post_id, "_slider_title", $slider_title);
        }

        if (isset($_POST["_slider_button"])) {
            $slider_button = $_POST["_slider_button"];
            update_post_meta($post_id, "_slider_button", $slider_button);
        } else {
            update_post_meta($post_id, "_slider_button", __("Get it now"));
        }

        if (isset($_POST["_slider_link"])) {
            $slider_link = $_POST["_slider_link"];
            update_post_meta($post_id, "_slider_link", $slider_link);
        } else {
            update_post_meta($post_id, "_slider_link", site_url("/"));
        }
    }
}
