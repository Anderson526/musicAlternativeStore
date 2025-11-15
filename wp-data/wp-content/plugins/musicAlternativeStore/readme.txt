Music Alternative Store - Plugin

Estructura y uso básico (en español)

Archivos principales:
- music-alternative-store.php: archivo principal del plugin.
- includes/class-mas-admin.php: página de ajustes y registro de opciones.
- includes/class-mas-shortcodes.php: shortcodes disponibles (ej: [mas_featured_music]).
- includes/class-mas-endpoints.php: registra endpoints REST y endpoint en Mi Cuenta (/mi-cuenta/music-options/).
- includes/class-mas-helpers.php: helpers.
- templates/endpoint-account.php: plantilla que se renderiza dentro de "Mi cuenta" cuando se accede a /mi-cuenta/music-options/.
- assets/: css y js para frontend/admin.
- uninstall.php: limpia las opciones al desinstalar.

Cómo usar:
1) Instala y activa el plugin.
2) Ve a WooCommerce > Music Options para configurar el campo "Artista por defecto".
3) Usa el shortcode: [mas_featured_music count="4"] para mostrar productos (usa WC_Product_Query).
4) Endpoint REST protegido para usuarios autenticados:
   GET  /wp-json/musicstore/v1/user-options -> obtiene las opciones del usuario
   POST /wp-json/musicstore/v1/user-options -> guarda opciones (envía JSON)
5) Endpoint en "Mi cuenta": visita "Mi cuenta" y abre la URL /mi-cuenta/music-options/ (dependiendo del slug de tu instalación).

Notas:
- Este es un esqueleto. Integra validaciones, capacidades y UI según tus necesidades.
- Recuerda hacer flush_rewrite_rules() tras activar para que el endpoint de Mi Cuenta funcione.
