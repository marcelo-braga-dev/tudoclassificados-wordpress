<?php

/**
 * This template displays the public-facing aspects of the widget.
 *
 * @link    https://pluginsware.com
 * @since   1.0.0
 *
 * @package Advanced_Classifieds_And_Directory_Pro
 */

require_once ABSPATH . 'wp-functions/widgets/anuncios_lateral.php';
return;
?>

<?php /*
<!-- the loop -->
$columns = $instance['columns'];
$span = 'col-md-' . floor(12 / $columns);
$i = 0;

while ($acadp_query->have_posts()) :
	$acadp_query->the_post();
	$post_meta = get_post_meta($post->ID);
?>

	<div class="card shadow-sm mb-3">
		<div class="mx-auto">
			<a class="media-object" href="<?php the_permalink(); ?>"><?php the_acadp_listing_thumbnail($post_meta); ?></a>
		</div>
		<div class="border-top p-2 px-4">
			<?php
			if ($instance['has_price'] && $instance['show_price'] && isset($post_meta['price']) && $post_meta['price'][0] > 0) {
				$price = acadp_format_amount($post_meta['price'][0]);
				echo '<span class="lead acadp-listings-price">' . esc_html(acadp_currency_filter($price)) . '</span>';
			}
			the_acadp_listing_labels($post_meta);
			?>
			<div class="w-100"></div>
		</div>
		<div class="card-footer bg-white border-top-0 border pt-0 animado">
			<small class="text-muted">
				<a style="text-decoration:none; color:gray" href="<?php the_permalink(); ?>"><?php echo esc_html(get_the_title()); ?></a>
			</small>
		</div>
	</div>

	<!--
    	<?php if ($i % $columns == 0) : ?>
  			<div class="row border shadow-sm rounded p-2">
        <?php endif; ?>        
        	<div class="<?php echo esc_attr($span); ?>">
            	<div <?php the_acadp_listing_entry_class($post_meta, 'media'); ?>>
                	
                	<?php if ($instance['has_images'] && $instance['show_image']) : ?>
                    	<div class="media-left">
                			<a class="media-object" href="<?php the_permalink(); ?>"><?php the_acadp_listing_thumbnail($post_meta); ?></a>     
                       	</div> 	
            		<?php endif; ?>
            
            		<div class="media-body">
                    	<div class="acadp-listings-title-block">
                    		<h4 class="media-heading"><a href="<?php the_permalink(); ?>"><?php echo esc_html(get_the_title()); ?></a></h4>
                            <?php the_acadp_listing_labels($post_meta); ?>
                        </div>
                        
                        <?php /*
						$info = array();					
	
						if ( $instance['show_date'] ) {
							$info[] = sprintf( esc_html__( 'Posted %s ago', 'advanced-classifieds-and-directory-pro' ), human_time_diff( get_the_time( 'U' ), current_time( 'timestamp' ) ) );
						}
						
						if ( $instance['show_user'] ) {			
							$info[] = '<a href="' . esc_url( acadp_get_user_page_link( $post->post_author ) ) . '">' . get_the_author() . '</a>';
						}

						echo '<p class="acadp-no-margin"><small class="text-muted">' . implode( ' ' . esc_html__( "by", 'advanced-classifieds-and-directory-pro' ) . ' ', $info ) . '</small></p>';
						
						if ( $instance['show_description'] ) {
							if ( ! empty( $post->post_content ) && ! empty( $this->listings_settings['excerpt_length'] ) ) {
								echo '<p class="acadp-listings-desc">' . wp_trim_words( get_the_content(), $this->listings_settings['excerpt_length'], '...' ) . '</p>';
							}
						}

						$info = array();					
	
						if ( $instance['show_category'] && $categories = wp_get_object_terms( $post->ID, 'acadp_categories' ) ) {
							$category_links = array();
							foreach ( $categories as $category ) {						
								$category_links[] = sprintf( '<a href="%s">%s</a>', esc_url( acadp_get_category_page_link( $category ) ), esc_html( $category->name ) );						
							}
							$info[] = sprintf( '<span class="glyphicon glyphicon-briefcase"></span>&nbsp;%s', implode( ', ', $category_links ) );
						}
				
						if ( $instance['has_location'] && $instance['show_location'] && $locations = wp_get_object_terms( $post->ID, 'acadp_locations' ) ) {
							$location_links = array();
							foreach ( $locations as $location ) {						
								$location_links[] = sprintf( '<a href="%s">%s</a>', esc_url( acadp_get_location_page_link( $location ) ), esc_html( $location->name ) );						
							}
							$info[] = sprintf( '<span class="glyphicon glyphicon-map-marker"></span>&nbsp;%s', implode( ', ', $location_links ) );
						}
						
						if ( $instance['show_views'] && ! empty( $post_meta['views'][0] ) ) {
							$info[] = sprintf( esc_html__( "%d views", 'advanced-classifieds-and-directory-pro' ), $post_meta['views'][0] );
						}

						echo '<p class="acadp-no-margin"><small>' . implode( ' / ', $info ) . '</small></p>';
                        
				if ($instance['has_price'] && $instance['show_price'] && isset($post_meta['price']) && $post_meta['price'][0] > 0) {
					$price = acadp_format_amount($post_meta['price'][0]);
					echo '<p class="lead acadp-listings-price">' . esc_html(acadp_currency_filter($price)) . '</p>';
				}
				?>
                    </div>
                </div>
            </div>
    	<?php
		$i++;
		if ($i % $columns == 0 || $i == $acadp_query->post_count) : ?>
			</div>-->

<?php endif; ?>
<?php endwhile; ?>
<!-- end of the loop -->

<!-- Use reset postdata to restore orginal query -->
<?php wp_reset_postdata(); ?>
*/