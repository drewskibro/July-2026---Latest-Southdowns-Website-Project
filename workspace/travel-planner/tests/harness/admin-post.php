<?php
require __DIR__ . '/wp.php';
$action = preg_replace( '/[^a-z_]/', '', (string) ( $_REQUEST['action'] ?? '' ) );
do_action( 'admin_post_' . $action );
http_response_code( 400 ); echo 'no such action';
