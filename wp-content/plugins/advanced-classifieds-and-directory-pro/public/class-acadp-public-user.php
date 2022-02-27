<?php

/**
 * User
 *
 * @link    https://pluginsware.com
 * @since   1.0.0
 *
 * @package Advanced_Classifieds_And_Directory_Pro
 */

// Exit if accessed directly
use TudoClassificados\Anuncios\FormulariosCadastro\AnuncioPadrao;
use TudoClassificados\Anuncios\Status\Deletar;
use TudoClassificados\Anuncios\Status\RemoverFavoritos;
use TudoClassificados\Anuncios\Status\Renovar;
use TudoClassificados\Services\Anuncios\Imagens\UploadAjax;
use TudoClassificados\Services\Shortcodes\Anuncios\AnunciosFavoritos;
use TudoClassificados\Services\Shortcodes\Anuncios\AnunciosUsuario;
use TudoClassificados\Services\Shortcodes\Anuncios\FormulariosCadastro\CustomFields\FieldsPadrao;
use TudoClassificados\Services\Shortcodes\Anuncios\FormulariosCadastro\FormPadrao;
use TudoClassificados\Services\Shortcodes\Anuncios\Gerenciar\Afiliado;
use TudoClassificados\Services\Shortcodes\Anuncios\Gerenciar\Classificados;
use TudoClassificados\Services\Shortcodes\Anuncios\Gerenciar\Imoveis;
use TudoClassificados\Services\Shortcodes\Anuncios\Gerenciar\Marketplace;
use TudoClassificados\Services\Shortcodes\Anuncios\Gerenciar\Padrao;

if (!defined('WPINC')) {
    die;
}

/**
 * ACADP_Public_User Class.
 *
 * @since 1.0.0
 */
class ACADP_Public_User
{

    /**
     * Get things going.
     *
     * @since 1.0.0
     */
    public function __construct()
    {
        // Register shortcodes used by the user page
        add_shortcode("acadp_user_listings", array($this, "run_shortcode_user_listings"));
        add_shortcode("acadp_user_dashboard", array($this, "run_shortcode_user_dashboard"));
        add_shortcode("acadp_listing_form", array($this, "run_shortcode_listing_form"));
        add_shortcode("acadp_manage_listings", array($this, "run_shortcode_manage_listings"));
        add_shortcode("acadp_favourite_listings", array($this, "run_shortcode_favourite_listings"));

        add_shortcode("acadp_manage_listings_filiado", array($this, "run_shortcode_manage_listings_afiliado"));
        add_shortcode("acadp_manage_listings_marketplace", array($this, "run_shortcode_manage_listings_marketplace"));
        add_shortcode("acadp_manage_listings_imoveis", array($this, "run_shortcode_manage_listings_imoveis"));
        add_shortcode("acadp_manage_listings_classificados", array($this, "run_shortcode_manage_listings_classificados"));
    }

    /**
     * Manage form submissions.
     *
     * @since 1.0.0
     */
    public function manage_actions()
    {
        if ('POST' == $_SERVER['REQUEST_METHOD'] && isset($_POST['acadp_listing_nonce']) && wp_verify_nonce($_POST['acadp_listing_nonce'], 'acadp_save_listing')) {
            if (isset($_POST['post_id'])) {
                if (!acadp_current_user_can('edit_acadp_listing', (int)$_POST['post_id'])) {
                    return;
                }
            } else {
                if (!acadp_current_user_can('edit_acadp_listings')) {
                    return;
                }

                if (!acadp_is_human('listing')) {
                    echo '<span>' . __('Invalid Captcha: Please try again.', 'advanced-classifieds-and-directory-pro') . '</span>';
                    exit();
                }
            }

            $this->save_listing();
        }
    }

    /**
     * Save Listing.
     *
     * @since  1.0.0
     * @access private
     */
    private function save_listing()
    {
        $anuncio = new AnuncioPadrao();
        $anuncio->execute();
    }

    /**
     * Parse request to find correct WordPress query.
     *
     * @param WP_Query $wp WordPress Query object.
     * @since 1.0.0
     */
    public function parse_request($wp)
    {
        if (array_key_exists('acadp_action', $wp->query_vars) && array_key_exists('acadp_listing', $wp->query_vars) && (int)$wp->query_vars['acadp_listing'] > 0) {
            $id = (int)$wp->query_vars['acadp_listing'];

            if ('renew' == $wp->query_vars['acadp_action']) {
                if (!acadp_current_user_can('edit_acadp_listing', $id)) {
                    return;
                }

                $this->renew_listing($id);
            }

            if ('delete' == $wp->query_vars['acadp_action']) {
                if (isset($_REQUEST['acadp_nonce']) && wp_verify_nonce($_REQUEST['acadp_nonce'], 'acadp_delete_nonce')) {
                    if (!acadp_current_user_can('delete_acadp_listing', $id)) {
                        return;
                    }

                    $this->delete_listing($id);
                }
            }

            if ('remove-favourites' == $wp->query_vars['acadp_action']) {
                $this->remove_favourites($id);
            }
        }
    }

    /**
     * Renew Listing.
     *
     * @param int $post_id Post ID.
     * @since  1.0.0
     * @access private
     */
    private function renew_listing($post_id)
    {
        $status = new Renovar();
        $status->execute($post_id);
    }

    /**
     * Delete Listing.
     *
     * @param int $post_id Post ID.
     * @since  1.0.0
     * @access private
     */
    private function delete_listing($post_id)
    {
        $status = new Deletar();
        $status->execute($post_id);
    }

    /**
     * Remove favourites.
     *
     * @param int $post_id Post ID.
     * @since 1.0.0
     */
    public function remove_favourites($post_id)
    {
        $status = new RemoverFavoritos();
        $status->executar($post_id);
    }

    /**
     * Process the shortcode [acadp_user_listings].
     *
     * @param array $atts An associative array of attributes.
     * @since  1.0.0
     * @access public
     */
    public function run_shortcode_user_listings($atts)
    {
        $anuncios = new AnunciosUsuario();
        $anuncios->execute($atts);
    }

    /**
     * Process the shortcode [acadp_user_dashboard].
     *
     * @since 1.0.0
     */
    public function run_shortcode_user_dashboard()
    {
        return acadp_get_template("user/acadp-public-user-dashboard-display.php");
    }

    /**
     * Process the shortcode [acadp_listing_form].
     *
     * @since 1.0.0
     */
    public function run_shortcode_listing_form()
    {
        $service = new FormPadrao();
        return $service->execute();
    }

    /**
     * Display custom fields.
     *
     * @param int $post_id Post ID.
     * @since 1.0.0
     */
    public function ajax_callback_custom_fields($post_id = 0)
    {
        $service =  new FieldsPadrao();
        $service->execute($post_id);
    }

    /**
     * Upload image.
     *
     * @since 1.0.0
     */
    public function ajax_callback_image_upload()
    {
        $service = new UploadAjax();
        $service->execute();
    }

    /**
     * Delete an attachment.
     *
     * @since 1.0.0
     */
    public function ajax_callback_delete_attachment()
    {
        check_ajax_referer('acadp_ajax_nonce', 'security');

        if (isset($_POST['attachment_id'])) {
            wp_delete_attachment((int)$_POST['attachment_id'], true);
        }

        wp_die();
    }

    /**
     * Process the shortcode [acadp_manage_listings_marketplace].
     *
     * @since 1.0.0
     */
    public function run_shortcode_manage_listings_marketplace()
    {
        $service = new Marketplace();
        return $service->executar();
    }

    /**
     * Process the shortcode [acadp_manage_listings_filiado].
     *
     * @since 1.0.0
     */
    public function run_shortcode_manage_listings_afiliado()
    {
        $service = new Afiliado();
        return $service->executar();
    }

    /**
     * Process the shortcode [acadp_manage_listings_imoveis].
     *
     * @since 1.0.0
     */
    public function run_shortcode_manage_listings_imoveis()
    {
        $service = new Imoveis();
        return $service->executar();
    }

    /**
     * Process the shortcode [acadp_manage_listings_marketplace].
     *
     * @since 1.0.0
     */
    public function run_shortcode_manage_listings_classificados()
    {
        $service = new Classificados();
        return $service->executar();
    }

    /**
     * Process the shortcode [acadp_manage_listings].
     *
     * @since 1.0.0
     */
    public function run_shortcode_manage_listings()
    {
        $service = new Padrao();
        return $service->execute();
    }

    /**
     * Process the shortcode [acadp_favourite_listings].
     *
     * @param array $atts An associative array of attributes.
     * @since 1.0.0
     */
    public function run_shortcode_favourite_listings($atts)
    {
        $service = new AnunciosFavoritos();
        return $service->execute($atts);
    }
}
