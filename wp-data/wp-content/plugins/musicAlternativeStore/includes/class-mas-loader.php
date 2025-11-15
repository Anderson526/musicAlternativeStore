<?php
if ( ! defined( 'ABSPATH' ) ) { exit; }

/**
 * Carga e inicializa las piezas principales del plugin.
 */
class MAS_Loader {
    public function run() {
        // Admin
        if ( is_admin() ) {
            new MAS_Admin();
        }

        // Shortcodes
        new MAS_Shortcodes();

        // Endpoints (REST y Mi Cuenta)
        new MAS_Endpoints();
    }
}
