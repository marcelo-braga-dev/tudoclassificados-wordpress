<?php

namespace TudoClassificados\Services\Anuncios\Imagens;

class UploadAjax
{
    public function execute()
    {
        if (isset($_POST['acadp_images_nonce']) && wp_verify_nonce($_POST['acadp_images_nonce'], 'acadp_upload_images')) {
            $data = array();

            if ($_FILES) {
                require_once(ABSPATH . "wp-admin" . '/includes/image.php');
                require_once(ABSPATH . "wp-admin" . '/includes/file.php');
                require_once(ABSPATH . "wp-admin" . '/includes/media.php');

                $files = $_FILES['acadp_image'];
                $post_id = 0;

                foreach ($files['name'] as $index => $value) {
                    if ($files['name'][$index]) {
                        $data[$index] = array(
                            'error' => 0,
                            'message' => ''
                        );

                        $file = array(
                            'name' => $files['name'][$index],
                            'type' => $files['type'][$index],
                            'tmp_name' => $files['tmp_name'][$index],
                            'error' => $files['error'][$index],
                            'size' => $files['size'][$index]
                        );

                        if (getimagesize($file['tmp_name']) === FALSE) {
                            $data[$index]['error'] = 1;
                            $data[$index]['message'] = __('File is not an image.', 'advanced-classifieds-and-directory-pro');
                        }

                        if (!in_array($file['type'], array('image/jpeg', 'image/jpg', 'image/png'))) {
                            $data[$index]['error'] = 1;
                            $data[$index]['message'] = __('Invalid file format', 'advanced-classifieds-and-directory-pro');
                        }

                        if ($file['error'] !== UPLOAD_ERR_OK) {
                            $data[$index]['error'] = 1;
                            $data[$index]['message'] = $file['error'];
                        }

                        if (0 == $data[$index]['error']) {
                            $_FILES = array('acadp_image' => $file);

                            $_FILES['acadp_image'] = acadp_exif_rotate($_FILES['acadp_image']);
                            $img_id = media_handle_upload('acadp_image', $post_id);

                            $data[$index]['id'] = $img_id;

                            $image = wp_get_attachment_image_src($img_id);
                            $data[$index]['url'] = $image[0];
                        }
                    }
                }
            }

            echo wp_json_encode($data);
        }

        wp_die();
    }
}