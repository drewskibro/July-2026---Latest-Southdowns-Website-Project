<?php
require __DIR__ . '/wp.php';
do_action( 'admin_menu' );
$page = $_GET['page'] ?? 'gtp-settings';
?><!doctype html><html lang="en-GB"><head><meta charset="utf-8"><title>wp-admin (harness)</title>
<style>body{font:14px/1.5 system-ui,sans-serif;margin:24px;max-width:1200px}table{border-collapse:collapse}td,th{padding:6px 10px;border-bottom:1px solid #ddd;text-align:left;vertical-align:top}.notice{padding:8px 12px;border-left:4px solid #2271b1;background:#f0f6fc;margin:12px 0}.notice-warning{border-color:#dba617;background:#fcf9e8}.large-text{width:100%}.regular-text{width:25em}label{margin-right:14px}</style></head><body>
<?php 'gtp-notices' === $page ? gtp_admin_notices_page() : gtp_admin_settings_page(); ?>
</body></html>
