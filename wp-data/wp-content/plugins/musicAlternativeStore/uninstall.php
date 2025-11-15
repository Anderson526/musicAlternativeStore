<?php
// Eliminar opciones y user_meta al desinstalar (si se borra el plugin desde WP)
if ( ! defined( 'WP_UNINSTALL_PLUGIN' ) ) {
    exit;
}

// Eliminar opciones globales
delete_option( 'mas_settings' );

// Eliminar meta de usuarios (opcional: mantener si prefieres conservar datos)
$users = get_users( array( 'fields' => 'ID' ) );
foreach ( $users as $user_id ) {
    delete_user_meta( $user_id, 'mas_user_options' );
}
