<?php

/**
 * Listing detail Page.
 *
 * @link    https://pluginsware.com
 * @since   1.0.0
 *
 * @package Advanced_Classifieds_And_Directory_Pro
 */

// Exit if accessed directly
if (!defined('WPINC')) {
    die;
}

/**
 * ACADP_Public_Listing Class.
 *
 * @since 1.0.0
 */
class ACADP_Public_Listing
{

    /**
     * Filter the post content.
     *
     * @param string $html The post thumbnail HTML.
     * @return string $html Filtered thumbnail HTML.
     * @since  1.5.4
     */
    public function post_thumbnail_html($html)
    {
        if (is_singular('acadp_listings')) {
            return '';
        }

        return $html;
    }

    /**
     * Filter the post content.
     *
     * @param string $content Content of the current post.
     * @return string $content Modified Content.
     * @since  1.0.0
     */
    public function the_content($content)
    {
        $service = new TudoClassificados\Shortcodes\Anuncios\AnuncioUnico();
        return $service->execute($content);
    }

    /**
     * Add or Remove favourites.
     *
     * @since 1.0.0
     */
    public function ajax_callback_add_remove_favorites()
    {
        check_ajax_referer('acadp_ajax_nonce', 'security');

        $post_id = (int)$_POST['post_id'];

        $favourites = (array)get_user_meta(get_current_user_id(), 'acadp_favourites', true);

        if (in_array($post_id, $favourites)) {
            if (($key = array_search($post_id, $favourites)) !== false) {
                unset($favourites[$key]);
            }
        } else {
            $favourites[] = $post_id;
        }

        $favourites = array_filter($favourites);
        $favourites = array_values($favourites);

        delete_user_meta(get_current_user_id(), 'acadp_favourites');
        update_user_meta(get_current_user_id(), 'acadp_favourites', $favourites);

        the_acadp_favourites_link($post_id);

        wp_die();
    }

    /**
     * Report Abuse.
     *
     * @since 1.0.0
     */
    public function ajax_callback_report_abuse()
    {
        check_ajax_referer('acadp_ajax_nonce', 'security');

        $data = array('error' => 0);

        if (acadp_is_human('report_abuse')) {
            if (acadp_email_admin_report_abuse()) {
                $data['message'] = __('Your message sent successfully.', 'advanced-classifieds-and-directory-pro');
            } else {
                $data['error'] = 1;
                $data['message'] = __('Sorry! Please try again.', 'advanced-classifieds-and-directory-pro');
            }
        } else {
            $data['error'] = 1;
            $data['message'] = __('Invalid Captcha: Please try again.', 'advanced-classifieds-and-directory-pro');
        }

        echo wp_json_encode($data);
        wp_die();
    }

    /**
     * Send contact email.
     *
     * @since 1.0.0
     */
    public function ajax_callback_send_contact_email()
    {
        check_ajax_referer('acadp_ajax_nonce', 'security');

        $data = array('error' => 0);

        if (acadp_is_human('contact')) {
            if (acadp_email_listing_owner_listing_contact()) {
                // Send a copy to admin( only if applicable ).
                acadp_email_admin_listing_contact();

                $data['message'] = __('Your message sent successfully.', 'advanced-classifieds-and-directory-pro');
            } else {
                $data['error'] = 1;
                $data['message'] = __('Sorry! Please try again.', 'advanced-classifieds-and-directory-pro');
            }
        } else {
            $data['error'] = 1;
            $data['message'] = __('Invalid Captcha: Please try again.', 'advanced-classifieds-and-directory-pro');
        }

        echo wp_json_encode($data);
        wp_die();
    }

}
