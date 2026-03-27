<?php
/**
 * Laravel router for PHP built-in development server
 * 
 * This file routes all requests through index.php for Laravel to handle
 */

$uri = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);
$file = __DIR__ . $uri;

// If a real file exists (not a directory), serve it directly
if (is_file($file)) {
    return false;
}

// For everything else (routes), load index.php
require_once __DIR__ . '/index.php';




