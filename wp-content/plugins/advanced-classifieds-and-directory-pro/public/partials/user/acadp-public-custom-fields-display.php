<!-- <label class="control-label">< ?php echo esc_html(get_the_title()); ?></label> -->
<?php

/**
 * This template adds custom fields to the listing form.
 *
 * @link    https://pluginsware.com
 * @since   1.0.0
 *
 * @package Advanced_Classifieds_And_Directory_Pro
 */
?>

<?php
if ($acadp_query->have_posts()) :
	
	while ($acadp_query->have_posts()) :
		$acadp_query->the_post();
		$field_meta = get_post_meta($post->ID);
?>
		<?php
		$required_label = $required_attr = '';

		if (1 == $field_meta['required'][0]) {
			$required_label = '<span class="acadp-star">*</span>';

			if ('checkbox' == $field_meta['type'][0]) {
				$required_attr = ' class="acadp_fields_' . $post->ID . '" data-cb_required="acadp_fields_' . $post->ID . '"';
			} else {
				$required_attr = ' required';
			}
		}
		?>


		<?php if (!empty($field_meta['instructions'][0])) : ?>
			<small class="help-block"><?php echo esc_html($field_meta['instructions'][0]); ?></small>
		<?php endif; ?>

		<?php
		$value = $field_meta['default_value'][0];
		if (isset($post_meta[$post->ID])) {
			$value = $post_meta[$post->ID][0];
		}

		switch ($field_meta['type'][0]) {
			case 'text':
				echo '<div class="col-md-2">
						<div class="form-group">
							<label style="font-size:  12px;">' . esc_html(get_the_title()) . '</label>';
				printf('		<input type="text" name="acadp_fields[%d]" class="form-control" placeholder="%s" value="%s"%s/>', $post->ID, esc_attr($field_meta['placeholder'][0]), esc_attr($value), $required_attr);
				echo 		'</div>
					</div>';
				break;
			case 'textarea':
				printf('<textarea name="acadp_fields[%d]" class="form-control" rows="%d" placeholder="%s"%s>%s</textarea>', $post->ID, esc_attr($field_meta['rows'][0]), esc_attr($field_meta['placeholder'][0]), $required_attr, esc_textarea($value));
				break;
			case 'select':
				$choices = $field_meta['choices'][0];
				$choices = explode("\n", trim($choices));

				printf('<select name="acadp_fields[%d]" class="form-control"%s>', $post->ID, $required_attr);
				if (!empty($field_meta['allow_null'][0])) {
					printf('<option value="">%s</option>', '- ' . esc_html__('Select an Option', 'advanced-classifieds-and-directory-pro') . ' -');
				}

				foreach ($choices as $choice) {
					if (strpos($choice, ':') !== false) {
						$_choice = explode(':', $choice);
						$_choice = array_map('trim', $_choice);

						$_value  = $_choice[0];
						$_label  = $_choice[1];
					} else {
						$_value  = trim($choice);
						$_label  = $_value;
					}

					$_selected = '';
					if (trim($value) == $_value) {
						$_selected = ' selected="selected"';
					}

					printf('<option value="%s"%s>%s</option>', esc_attr($_value), $_selected, esc_html($_label));
				}
				echo '</select>';
				break;
			case 'checkbox':
				$choices = $field_meta['choices'][0];
				$choices = explode("\n", trim($choices));

				$values = explode("\n", $value);
				$values = array_map('trim', $values);

				echo 	'
				<div class="w-100"></div>
					<div class="col-12">
						<div class="form-row">
					';
				
				foreach ($choices as $choice) {
					if (strpos($choice, ':') !== false) {
						$_choice = explode(':', $choice);
						$_choice = array_map('trim', $_choice);
						
						$_value  = $_choice[0];
						$_label  = $_choice[1];
					} else {
						$_value  = trim($choice);
						$_label  = $_value;
					}
					
					$_attr = '';
					if (in_array($_value, $values)) {
						$_attr .= ' checked="checked"';
					}
					$_attr .= $required_attr;

					echo 
					'<div class=" col-6 col-md-3">
						<div class="form-check">
							<label class="form-check-label" style="font-size:12px">
								<input type="hidden" name="acadp_fields['.$post->ID.'][]" value="" />
								<input class="form-check-input" type="checkbox"  name="acadp_fields['.$post->ID.'][]" value="'.esc_attr($_value).'" '.$_attr.'>
									'.esc_html($_label).'
								<span class="form-check-sign">
									<span class="check"></span>
								</span>
							</label>
						</div>
					</div>';
				}
				echo '
						</div>
					</div>
				</div>
				<div class="w-100 mb-3"></div>';
				
				break;

			case 'radio':
				$choices = $field_meta['choices'][0];
				$choices = explode("\n", trim($choices));

				echo
				'<div class="w-100">';
				foreach ($choices as $choice) {
					if (strpos($choice, ':') !== false) {
						$_choice = explode(':', $choice);
						$_choice = array_map('trim', $_choice);

						$_value  = $_choice[0];
						$_label  = $_choice[1];
					} else {
						$_value  = trim($choice);
						$_label  = $_value;
					}

					$_attr = '';
					if (trim($value) == $_value) {
						$_attr .= ' checked="checked"';
					}
					$_attr .= $required_attr;
					
					echo '
						<div class="form-check form-check-radio form-check-inline">
  							<label class="form-check-label" style="vertcal-align:middle">';
							  	printf('<input class="form-check-input" type="radio" name="acadp_fields[%d]" value="%s"%s>%s', $post->ID, esc_attr($_value), $_attr, esc_html($_label));
    					echo ' 
								<span class="circle">
        								<span class="check"></span>
    								</span>
  							</label>
						</div>';					
				}
				echo '</div>';
				break;

			case 'url':
				printf('<input type="text" name="acadp_fields[%d]" class="form-control" placeholder="%s" value="%s"%s/>', $post->ID, esc_attr($field_meta['placeholder'][0]), esc_url($value), $required_attr);
				break;
		}
		?>

<?php
	endwhile;
endif;
