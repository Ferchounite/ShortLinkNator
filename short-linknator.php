<?php
/*
Plugin Name: Short Linknator
Plugin URI: https://fernandoardila.dev
Description: Short Linknator es un plugin para WordPress que permite acortar las URLs de tus páginas, posts y tipos de contenido personalizado (CPT).
Version: 1.1
Author: Fernando Ardila
Author URI: https://fernandoardila.dev
License: GPL2
*/

// Asegurarse de que el código no se ejecute si se accede directamente.
if (!defined('ABSPATH')) {
    exit;
}

// Hook para añadir shortcodes y estilos
add_action('init', 'short_linknator_register_shortcodes');
add_action('wp_enqueue_scripts', 'short_linknator_enqueue_styles');

function short_linknator_register_shortcodes() {
    add_shortcode('short_url_this_page', 'short_linknator_generate_shortcode');
}

function short_linknator_enqueue_styles() {
    wp_enqueue_style('short-linknator-style', plugins_url('style.css', __FILE__));
}

function short_linknator_generate_shortcode() {
    global $post;
    if (is_singular()) {
        $short_url = short_linknator_get_short_url(get_permalink($post->ID));
        $output = '<div class="short-linknator">';
        $output .= '<p>La URL corta para compartir esta página o post es: <strong>' . $short_url . '</strong></p>';
        $output .= '<button class="short-linknator-copy-btn" onclick="short_linknator_copy_url()">Copiar URL</button>';
        $output .= '</div>';
        $output .= '<script>
                    function short_linknator_copy_url() {
                        navigator.clipboard.writeText("' . $short_url . '").then(function() {
                            alert("URL copiada al portapapeles!");
                        }, function(err) {
                            alert("Error al copiar la URL: " + err);
                        });
                    }
                    </script>';
        return $output;
    }
    return '';
}

function short_linknator_get_short_url($url) {
    global $wpdb;
    $post_id = url_to_postid($url);
    $unique_hash = get_post_meta($post_id, 'short_url_hash', true);

    if (!$unique_hash) {
        $unique_hash = substr(md5($post_id . $url), 0, 10);
        update_post_meta($post_id, 'short_url_hash', $unique_hash);
    }

    return home_url('/' . $unique_hash);
}

// Manejar redirecciones desde URLs cortas
add_action('init', 'short_linknator_handle_redirects');

function short_linknator_handle_redirects() {
    $request_uri = trim($_SERVER['REQUEST_URI'], '/');
    if (strlen($request_uri) == 10) {
        global $wpdb;
        $post_id = $wpdb->get_var($wpdb->prepare(
            "SELECT post_id FROM $wpdb->postmeta WHERE meta_key = 'short_url_hash' AND meta_value = %s",
            $request_uri
        ));
        if ($post_id) {
            wp_redirect(get_permalink($post_id), 301);
            exit;
        }
    }
}

// Guardar el hash único al crear o actualizar un post
add_action('save_post', 'short_linknator_save_post');

function short_linknator_save_post($post_id) {
    if (wp_is_post_revision($post_id)) return;

    $url = get_permalink($post_id);
    $unique_hash = substr(md5($post_id . $url), 0, 10);
    update_post_meta($post_id, 'short_url_hash', $unique_hash);
}

// Activar el plugin
register_activation_hook(__FILE__, 'short_linknator_activate');

function short_linknator_activate() {
    // Actualizar enlaces permanentes al activar el plugin
    flush_rewrite_rules();
}

// Desactivar el plugin
register_deactivation_hook(__FILE__, 'short_linknator_deactivate');

function short_linknator_deactivate() {
    // Actualizar enlaces permanentes al desactivar el plugin
    flush_rewrite_rules();
}