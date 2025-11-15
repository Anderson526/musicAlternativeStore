<?php
/**
 * Plugin Name: Music Alternative Store - Opciones Personalizadas
 * Description: Añade opciones personalizadas, shortcodes y endpoints (REST + Mi Cuenta) para una tienda WooCommerce de música.
 * Version: 0.1.0
 * Author: Autor del Proyecto
 * Text Domain: music-alternative-store
 */

if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

define( 'MAS_PLUGIN_FILE', __FILE__ );
define( 'MAS_PLUGIN_DIR', plugin_dir_path( __FILE__ ) );
define( 'MAS_PLUGIN_URL', plugin_dir_url( __FILE__ ) );

// Cargar clases
require_once MAS_PLUGIN_DIR . 'includes/class-mas-loader.php';
require_once MAS_PLUGIN_DIR . 'includes/class-mas-admin.php';
require_once MAS_PLUGIN_DIR . 'includes/class-mas-shortcodes.php';
require_once MAS_PLUGIN_DIR . 'includes/class-mas-endpoints.php';
require_once MAS_PLUGIN_DIR . 'includes/class-mas-helpers.php';

// Inicializar
function mas_init_plugin() {
    $loader = new MAS_Loader();
    $loader->run();
}
add_action( 'plugins_loaded', 'mas_init_plugin' );

// Activación
function mas_activate() {
    // Registrar endpoint de reescritura y forzar flush
    if ( class_exists( 'MAS_Endpoints' ) ) {
        $ep = new MAS_Endpoints();
        $ep->register_account_endpoint();
    }
    flush_rewrite_rules();
}
register_activation_hook( __FILE__, 'mas_activate' );

// Desactivación
function mas_deactivate() {
    flush_rewrite_rules();
}
register_deactivation_hook( __FILE__, 'mas_deactivate' );
