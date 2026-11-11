<?php
/**
 * Removing the plugin removes what it kept: its settings, the notices it
 * read and the ones added by hand, and its daily reading.
 */
if ( ! defined( 'WP_UNINSTALL_PLUGIN' ) ) { exit; }
delete_option( 'gtp_settings' );
delete_option( 'gtp_notices' );
wp_clear_scheduled_hook( 'gtp_read_notices' );
