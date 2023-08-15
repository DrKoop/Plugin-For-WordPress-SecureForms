<?php
/*
    Plugin Name: Secure Forms
    Description: Plugin para detectar hipervínculos, enlaces, caracteres especiales, evita la inyección de código en tus formularios.
    Version: 1.0
    Author: Alejandro Rodriguez Aka (Dr. Koop)
    Author URI: https://drkoopdev.com/
    License: GNU General Public License v2 or later
    License URI: http://www.gnu.org/licenses/gpl-2.0.html
    Tags: Web Form Security, Data Protection, Code Injection Prevention,Form Validation,Cybersecurity,Form Protection,Data Security,Attack Prevention,Forms Firewall ,Online Security.
    Domain Path: /languages
*/

if(!defined('ABSPATH')) die();

function secure_forms_enqueue_scripts() {
    wp_enqueue_script('form-security-script', plugin_dir_url(__FILE__) . 'js/form-security.js', array('jquery'), '1.0', true);
    wp_localize_script('form-security-script', 'formSecurity', array( 
        'specialCharactersMessage' => __('No se permiten caracteres especiales.', 'form-security')
    ) );

    wp_enqueue_style('bootstrap-css', 'https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css');
    wp_enqueue_script('bootstrap-js', 'https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js', array('jquery'), '4.5.2', true);
}
add_action('wp_enqueue_scripts', 'secure_forms_enqueue_scripts');


function secure_forms_detect_special_characters($form_tag) {
    ob_start();
    ?>
    <div id="form-security-alert"  class="alert alert-danger text-center w-50 mx-auto rounded p-3" style="display: none;">
        <p><?php echo __('No se permiten caracteres especiales.', 'form-security'); ?></p>
    </div>
    <?php
    $output = ob_get_clean();
    $form_tag .= $output;
    return $form_tag;
}
add_filter('the_content', 'secure_forms_detect_special_characters');

function secure_forms_load_plugin_textdomain() {
    load_plugin_textdomain('form-security', false, dirname(plugin_basename(__FILE__)) . './languages/');
}
add_action('plugins_loaded', 'secure_forms_load_plugin_textdomain');