<?php
add_action('slider_add_form_fields', 'usegroup_add_slider_fields');
add_action('category_edit_form_fields', 'usegroup_add_slider_fields', 10);
function usegroup_add_slider_fields($term)
{
	$slider_button = "";
	$slider_link = "";

	if (isset($term->term_id)) {
		$slider_link = get_term_meta($term->term_id, '_slider_link', true);
		$slider_button = get_term_meta($term->term_id, '_slider_button', true);
		$thumbnail_id = absint(get_term_meta($term->term_id, 'thumbnail_id', true));
	}

	$placeholder = public_url("img/placeholder.png");
?>
	<div class="form-field form-required term-slider-button-wrap">
		<label for="tag-slider-button"><?php _e("Slider Button", "usegroup") ?></label>
		<input id="tag-slider-button" type="text" value="<?php echo $slider_button != "" ? $slider_button : __("Get Now") ?>" name="_slider_button" placeholder="<?php _e("Slider Button") ?>">
	</div>

	<div class="form-field form-required term-slider-link-wrap">
		<label for="tag-slider-link"><?php _e("Slider Link", "usegroup") ?></label>
		<input id="tag-slider-link" type="text" value="<?php echo $slider_link != "" ? $slider_link : site_url("/") ?>" name="_slider_link" placeholder="<?php _e("Slider Link") ?>">
	</div>

	<div class="form-field term-thumbnail-wrap">
		<label for="tag-slider-link"><?php _e("Slider Image", "usegroup") ?></label>
		<div class="relative">
			<input type="hidden" id="slider_thumbnail_id" name="slider_thumbnail_id" />
			<div id="slider_thumbnail">
				<img src="<?php echo $placeholder; ?>" id="slider_thumbnail_placeholder" style="height: 50px;" alt="">
			</div>
		</div>
		<script type="text/javascript">
		</script>
		<div class="clear"></div>
	</div>
<?php
}

add_action('created_term',  'save_post_slider_fields', 10, 3);
add_action('edit_term',  'save_post_slider_fields', 10, 3);
function save_post_slider_fields($term_id, $tt_id = '', $taxonomy = '')
{
	if (isset($_POST['_slider_button']) && 'slider' === $taxonomy) { // WPCS: CSRF ok, input var ok.
		update_term_meta($term_id, '_slider_button', $_POST['_slider_button']); // WPCS: CSRF ok, input var ok.
	}
	if (isset($_POST['_slider_link']) && 'slider' === $taxonomy) { // WPCS: CSRF ok, input var ok.
		update_term_meta($term_id, '_slider_link', $_POST['_slider_link']); // WPCS: CSRF ok, input var ok.
	}
	if (isset($_POST['slider_thumbnail_id']) && 'slider' === $taxonomy) { // WPCS: CSRF ok, input var ok.
		update_term_meta($term_id, 'thumbnail_id', absint($_POST['slider_thumbnail_id'])); // WPCS: CSRF ok, input var ok.
	}
}

add_filter('manage_edit-slider_columns',  'custom_slider_columns');
function custom_slider_columns($columns)
{
	$new_columns = array();

	if (isset($columns['cb'])) {
		$new_columns['cb'] = $columns['cb'];
		// unset($columns['cb']);
	}
	unset($columns["slug"]);
	unset($columns["description"]);
	unset($columns["posts"]);
	// unset($columns["name"]);

	$new_columns['name'] = __('Name/Title', 'usegroup');
	$new_columns['_thumb'] = __('Image', 'usegroup');
	$new_columns['_button'] = __('Text', 'usegroup');
	$new_columns['_link'] = __('Link', 'usegroup');

	$columns           = array_merge($columns, $new_columns);
	$columns['handle'] = '';
	return $columns;
}
add_filter('manage_slider_custom_column', 'custom_slider_column', 10, 3);
function custom_slider_column($columns, $column, $id)
{

	if ('_thumb' === $column) {
		// Prepend tooltip for default slider.
		$default_slider_id = absint(get_option('default_category', 0));

		$thumbnail_id = get_term_meta($id, 'thumbnail_id', true);

		if ($thumbnail_id) {
			$image = wp_get_attachment_url($thumbnail_id);
		} else {
			$image = public_url("img/placeholder.png");
		}

		$image    = str_replace(' ', '%20', $image);
		$columns .= '<img src="' . esc_url($image) . '" alt="' . esc_attr__('Thumbnail', 'usegroup') . '" class="wp-post-image" height="48" width="48" />';
	}

	if ('_button' === $column) {
		$_slider_button = get_term_meta($id, '_slider_button', true);
		$columns .= $_slider_button != "" ? $_slider_button :  __("Unknown", 'usegroup');
	}

	if ('_link' === $column) {
		$_slider_link = get_term_meta($id, '_slider_link', true);
		$columns .= $_slider_link != "" ? $_slider_link :  __("Unknown", 'usegroup');
	}

	if ('handle' === $column) {
		$columns .= '<input type="hidden" name="term_id" value="' . esc_attr($id) . '" />';
	}
	return $columns;
}
