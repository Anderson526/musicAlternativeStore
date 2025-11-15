<?php
if ( ! defined( 'ABSPATH' ) ) { exit; }

/**
 * Funciones helper compartidas
 */
class MAS_Helpers {
    public static function get_setting( $key, $default = '' ) {
        $opts = get_option( 'mas_settings', array() );
        return isset( $opts[ $key ] ) ? $opts[ $key ] : $default;
    }
}
