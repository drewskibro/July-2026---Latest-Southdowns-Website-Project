<?php
/**
 * Removing the plugin removes what it kept: its settings, the notices it
 * read and the ones added by hand, its daily reading, and its last look at
 * the updates file.
 */
if ( ! defined( 'WP_UNINSTALL_PLUGIN' ) ) { exit; }
delete_option( 'gtp_settings' );
delete_option( 'gtp_notices' );
delete_option( 'gtp_notices_shown' );
delete_option( 'gtp_version_seen' );
delete_transient( 'gtp_update_info' );
wp_clear_scheduled_hook( 'gtp_read_notices' );
