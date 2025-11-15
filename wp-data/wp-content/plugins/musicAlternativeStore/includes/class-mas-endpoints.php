<?php
if ( ! defined( 'ABSPATH' ) ) { exit; }

/**
 * Registra endpoints personalizados: REST API y endpoint en "Mi cuenta" de WooCommerce
 */
class MAS_Endpoints {
    public function __construct() {
        add_action( 'rest_api_init', array( $this, 'register_rest_routes' ) );
        add_action( 'init', array( $this, 'register_account_endpoint' ) );
        add_filter( 'query_vars', array( $this, 'add_query_var' ) );
        add_action( 'template_redirect', array( $this, 'maybe_render_account_endpoint' ) );
    }

    // REST routes
    public function register_rest_routes() {
        register_rest_route( 'musicstore/v1', '/user-options', array(
            'methods' => 'GET',
            'callback' => array( $this, 'rest_get_user_options' ),
            'permission_callback' => function() { return is_user_logged_in(); }
        ) );

        register_rest_route( 'musicstore/v1', '/user-options', array(
            'methods' => 'POST',
            'callback' => array( $this, 'rest_update_user_options' ),
            'permission_callback' => function() { return is_user_logged_in(); }
        ) );
    }

    public function rest_get_user_options( $request ) {
        $user_id = get_current_user_id();
        if ( ! $user_id ) {
            return new WP_Error( 'no_user', 'No hay usuario', array( 'status' => 403 ) );
        }
        $opts = get_user_meta( $user_id, 'mas_user_options', true );
        return rest_ensure_response( $opts );
    }

    public function rest_update_user_options( $request ) {
        $user_id = get_current_user_id();
        if ( ! $user_id ) {
            return new WP_Error( 'no_user', 'No hay usuario', array( 'status' => 403 ) );
        }
        $data = $request->get_json_params();
        if ( ! is_array( $data ) ) {
            return new WP_Error( 'invalid_data', 'Datos inválidos', array( 'status' => 400 ) );
        }
        update_user_meta( $user_id, 'mas_user_options', $data );
        return rest_ensure_response( array( 'success' => true ) );
    }

    // Endpoint en Mi Cuenta
    public function register_account_endpoint() {
        // ejemplo: /mi-cuenta/music-options/
        add_rewrite_endpoint( 'music-options', EP_PAGES );
    }

    public function add_query_var( $vars ) {
        $vars[] = 'music-options';
        return $vars;
    }

    public function maybe_render_account_endpoint() {
        if ( ! is_account_page() ) {
            return;
        }

        global $wp_query;
        $val = get_query_var( 'music-options', false );
        if ( false === $val ) {
            return;
        }

        // Cargar plantilla propia si existe
        $tpl = MAS_PLUGIN_DIR . 'templates/endpoint-account.php';
        if ( file_exists( $tpl ) ) {
            // Evitar el theme loop por defecto
            status_header(200);
            include $tpl;
            exit;
        }
    }
}
