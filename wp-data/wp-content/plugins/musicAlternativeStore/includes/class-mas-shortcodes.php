<?php
if ( ! defined( 'ABSPATH' ) ) { exit; }

/**
 * Registra shortcodes para la tienda de música
 */
class MAS_Shortcodes {
    public function __construct() {
        add_shortcode( 'mas_featured_music', array( $this, 'shortcode_featured_music' ) );
    }

    public function shortcode_featured_music( $atts ) {
        $atts = shortcode_atts( array(
            'count' => 4,
        ), $atts, 'mas_featured_music' );

        if ( ! class_exists( 'WC_Product_Query' ) ) {
            return '<p>' . esc_html__( 'WooCommerce no está activo.', 'music-alternative-store' ) . '</p>';
        }

        $args = array(
            'limit' => intval( $atts['count'] ),
            'status' => 'publish',
        );

        $query = new WC_Product_Query( $args );
        $products = $query->get_products();

        ob_start();
        echo '<div class="mas-featured-music">';
        foreach ( $products as $product ) {
            echo '<div class="mas-music-item">';
            echo '<a href="' . esc_url( $product->get_permalink() ) . '">';
            echo esc_html( $product->get_name() );
            echo '</a>';
            echo '</div>';
        }
        echo '</div>';
        return ob_get_clean();
    }
}
