<?php
if ( ! defined( 'ABSPATH' ) ) { exit; }

/**
 * Clase para páginas y opciones del admin
 */
class MAS_Admin {
    private $option_name = 'mas_settings';

    public function __construct() {
        add_action( 'admin_menu', array( $this, 'add_settings_page' ) );
        add_action( 'admin_init', array( $this, 'register_settings' ) );
    }

    public function add_settings_page() {
        add_submenu_page(
            'woocommerce',
            __( 'Music Store Options', 'music-alternative-store' ),
            __( 'Music Options', 'music-alternative-store' ),
            'manage_woocommerce',
            'mas-settings',
            array( $this, 'render_settings_page' )
        );
    }

    public function register_settings() {
        register_setting( 'mas_options_group', $this->option_name );

        add_settings_section(
            'mas_main_section',
            __( 'Configuración principal', 'music-alternative-store' ),
            array( $this, 'section_cb' ),
            'mas-settings'
        );

        add_settings_field(
            'mas_default_artist',
            __( 'Artista por defecto', 'music-alternative-store' ),
            array( $this, 'field_default_artist_cb' ),
            'mas-settings',
            'mas_main_section'
        );
    }

    public function section_cb() {
        // Descripción de la sección (vacía por defecto)
    }

    public function field_default_artist_cb() {
        $opts = get_option( $this->option_name, array() );
        $val = isset( $opts['default_artist'] ) ? esc_attr( $opts['default_artist'] ) : '';
        echo "<input type=\"text\" name=\"{$this->option_name}[default_artist]\" value=\"{$val}\" class=\"regular-text\" />";
    }

    public function render_settings_page() {
        ?>
        <div class="wrap">
            <h1><?php esc_html_e( 'Music Store Options', 'music-alternative-store' ); ?></h1>
            <form method="post" action="options.php">
                <?php
                settings_fields( 'mas_options_group' );
                do_settings_sections( 'mas-settings' );
                submit_button();
                ?>
            </form>
        </div>
        <?php
    }
}
