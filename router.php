<?php
// router.php - PHP built-in server router for pretty URLs

$uri = urldecode(parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH));
$file = __DIR__ . $uri;

if ($uri !== '/' && file_exists($file) && !is_dir($file)) {
    // Serve static files directly
    return false;
}

// Fallback to index.php for application routes
require __DIR__ . '/index.php';
