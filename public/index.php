<?php

// Basic Router for PHP API
$uri = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);

// API Routes
if (strpos($uri, '/api') === 0) {
    header('Content-Type: application/json');
    require_once __DIR__ . '/../routes/api.php';
    exit;
}

// Serve Static Assets (if not handled by Vite/Server)
if (file_exists(__DIR__ . $uri) && !is_dir(__DIR__ . $uri)) {
    return false; // Serve file as-is
}

// Fallback to Index (for SPA routing)
// In development, Vite handles this. In production, this serves built index.html
if (file_exists(__DIR__ . '/index.html')) {
    readfile(__DIR__ . '/index.html');
} else {
    echo "Running in Development Mode: Please run 'npm run dev' for frontend.";
}
