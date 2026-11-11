<?php
/* php -S 127.0.0.1:8911 router.php : the plugin and the theme's files as a browser asks for them, then the harness's pages. */
$path = parse_url( $_SERVER['REQUEST_URI'], PHP_URL_PATH );
$root = dirname( __DIR__, 4 );
$types = array( 'css' => 'text/css', 'js' => 'application/javascript', 'json' => 'application/json', 'woff2' => 'font/woff2', 'woff' => 'font/woff', 'webp' => 'image/webp', 'png' => 'image/png', 'jpg' => 'image/jpeg', 'svg' => 'image/svg+xml' );
foreach ( array( '/plugin/' => $root . '/gildhart-travel-planner/', '/theme/' => $root . '/southdowns-pharmacy-theme/' ) as $prefix => $dir ) {
	if ( 0 === strpos( $path, $prefix ) ) {
		$file = realpath( $dir . substr( $path, strlen( $prefix ) ) );
		if ( ! $file || 0 !== strpos( $file, realpath( $dir ) ) || ! is_file( $file ) || 'php' === pathinfo( $file, PATHINFO_EXTENSION ) ) { http_response_code( 404 ); echo 'not found'; return true; }
		header( 'Content-Type: ' . ( $types[ pathinfo( $file, PATHINFO_EXTENSION ) ] ?? 'application/octet-stream' ) );
		header( 'Cache-Control: no-store' );
		readfile( $file );
		return true;
	}
}
$page = __DIR__ . ( '/' === $path ? '/page.php' : $path );
if ( is_file( $page ) && 'php' === pathinfo( $page, PATHINFO_EXTENSION ) ) { require $page; return true; }
http_response_code( 404 ); echo 'not found';
return true;
