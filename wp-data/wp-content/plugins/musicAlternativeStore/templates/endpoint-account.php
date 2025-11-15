<?php
if ( ! defined( 'ABSPATH' ) ) { exit; }

/* Template para mostrar opciones del usuario dentro de Mi Cuenta */
get_header();
?>
<div class="mas-account-endpoint">
    <h2><?php esc_html_e( 'Mis opciones de música', 'music-alternative-store' ); ?></h2>
    <?php if ( is_user_logged_in() ):
        $user_id = get_current_user_id();
        $opts = get_user_meta( $user_id, 'mas_user_options', true );
    ?>
        <pre><?php echo esc_html( wp_json_encode( $opts, JSON_PRETTY_PRINT ) ); ?></pre>
        <p><?php esc_html_e( 'Aquí puedes integrar un formulario JS que consuma el endpoint REST para actualizar las opciones.', 'music-alternative-store' ); ?></p>
    <?php else: ?>
        <p><?php esc_html_e( 'Debes iniciar sesión para ver esta página.', 'music-alternative-store' ); ?></p>
    <?php endif; ?>
</div>
<?php
get_footer();
