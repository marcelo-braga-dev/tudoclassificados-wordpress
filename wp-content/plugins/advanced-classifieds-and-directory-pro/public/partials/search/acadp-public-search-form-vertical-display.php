<?php

/**
 * This template displays the public-facing aspects of the widget.
 *
 * @link    https://pluginsware.com
 * @since   1.0.0
 *
 * @package Advanced_Classifieds_And_Directory_Pro
 */
?>

<div class="acadp acadp-search acadp-search-vertical">
	<form action="<?php echo esc_url( acadp_get_search_action_page_link() ); ?>" class="form-vertical" role="form">
    	<?php if ( ! get_option('permalink_structure') ) : ?>
        	<input type="hidden" name="page_id" value="<?php if ( $page_settings['search'] > 0 ) echo esc_attr( $page_settings['search'] ); ?>">
        <?php endif; ?>
        
        <?php if ( isset( $_GET['lang'] ) ) : ?>
        	<input type="hidden" name="lang" value="<?php echo esc_attr( $_GET['lang'] ); ?>">
        <?php endif; ?>
        
    	<div class="form-group">
			<input type="text" name="q" class="form-control" placeholder="<?php esc_attr_e( 'Enter your keyword here ...', 'advanced-classifieds-and-directory-pro' ); ?>" value="<?php if ( isset( $_GET['q'] ) ) echo esc_attr( $_GET['q'] ); ?>">
		</div>        
        
        <?php if ( $has_location && $can_search_by_location ) : ?>
         	<!-- Location field -->
			<div class="form-group">
            	<label><?php esc_html_e( 'Select location', 'advanced-classifieds-and-directory-pro' ); ?></label>
				<?php 
				acadp_dropdown_terms(array(
					'show_option_none'  => '-- ' . esc_html__( 'Select location', 'advanced-classifieds-and-directory-pro' ) . ' --',
					'option_none_value' => (int) $general_settings['base_location'],
					'base_term'         => max( 0, (int) $general_settings['base_location'] ),
					'parent'            => max( 0, (int) $general_settings['base_location'] ),
					'taxonomy'          => 'acadp_locations',
					'name' 			    => 'l',
					'class'             => 'form-control',
					'orderby'        	=> sanitize_text_field( $locations_settings['orderby'] ), 
					'order'         	=> sanitize_text_field( $locations_settings['order'] ),
					'selected'          => isset( $_GET['l'] ) ? (int) $_GET['l'] : -1
				));
				?>
			</div>
        <?php endif; ?>
        
        <?php if ( $can_search_by_category ) : ?>
        	<!-- Category field -->
			<div class="form-group">
            	<label><?php esc_html_e( 'Select category', 'advanced-classifieds-and-directory-pro' ); ?></label>
				<?php
				acadp_dropdown_terms(array(
					'show_option_none' => '-- ' . esc_html__( 'Select category', 'advanced-classifieds-and-directory-pro' ) . ' --',
					'option_none_value' => -1,
					'taxonomy'         => 'acadp_categories',
					'name' 			   => 'c',
					'class'            => 'form-control acadp-category-search',
					'orderby'          => sanitize_text_field( $categories_settings['orderby'] ), 
					'order'            => sanitize_text_field( $categories_settings['order'] ),
					'selected'         => isset( $_GET['c'] ) ? (int) $_GET['c'] : -1
				));
				?>
			</div>
        <?php endif; ?>        

        <?php if ( $can_search_by_custom_fields ) : ?>
        	 <!-- Custom fields -->
       		<div id="acadp-custom-fields-search-<?php echo esc_attr( $id ); ?>" class="acadp-custom-fields-search" data-style="<?php echo esc_attr( $style ); ?>">
  				<?php do_action( 'wp_ajax_acadp_custom_fields_search', isset( $_GET['c'] ) ? (int) $_GET['c'] : 0, $style ); ?>
			</div>
        <?php endif; ?>        
        
        <?php if ( $has_price && $can_search_by_price ) : ?>
        	<!-- Price fields -->
        	<div class="form-group">
       			<label><?php esc_html_e( 'Price Range', 'advanced-classifieds-and-directory-pro' ); ?></label>
                <div class="row">
        			<div class="col-md-6 col-xs-6">
  						<input type="text" name="price[0]" class="form-control" placeholder="<?php esc_attr_e( 'min', 'advanced-classifieds-and-directory-pro' ); ?>" value="<?php if ( isset( $_GET['price'] ) ) echo esc_attr( $_GET['price'][0] ); ?>">
            		</div>
            		<div class="col-md-6 col-xs-6">
            			<input type="text" name="price[1]" class="form-control" placeholder="<?php esc_attr_e( 'max', 'advanced-classifieds-and-directory-pro' ); ?>" value="<?php if ( isset( $_GET['price'] ) ) echo esc_attr( $_GET['price'][1] ); ?>">
             		</div>
                </div>
			</div>
        <?php endif; ?>
		
        <!-- Action buttons -->
		<button type="submit" class="btn btn-primary"><?php esc_html_e( 'Search Listings', 'advanced-classifieds-and-directory-pro' ); ?></button>
		<a href="<?php echo esc_url( get_permalink() ); ?>" class="btn btn-default"><?php esc_html_e( 'Reset', 'advanced-classifieds-and-directory-pro' ); ?></a>
    </form>
</div>