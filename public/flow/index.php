<?php
declare(strict_types=1);

// DEBUG: Enable error reporting to diagnose 500 errors
ini_set('display_errors', '1');
ini_set('display_startup_errors', '1');
error_reporting(E_ALL);

/**
 * Flow Dashboard Controller
 * 
 * Serves as the entry point for the Flow subdomain (flow.dragriver.ca).
 * Handles initialization, data fetching (future), and view rendering.
 */

// 1. Bootstrap Application
// Loads global configuration, database connections, and helper functions.
// We check multiple paths to handle differences between Local (nested) and cPanel (flat/subdomain) structures.
$bootstrapPaths = [
    __DIR__ . '/../../src/bootstrap.php', // Local: public/flow/ -> src/
    __DIR__ . '/../src/bootstrap.php',    // cPanel: public_html/flow/ -> public_html/src/
];

$bootstrapLoaded = false;
foreach ($bootstrapPaths as $path) {
    if (file_exists($path)) {
        require_once $path;
        $bootstrapLoaded = true;
        break;
    }
}

if (!$bootstrapLoaded) {
    die("<h1>System Error</h1><p>Could not locate <code>src/bootstrap.php</code>.</p><p>Please ensure the <code>src</code> folder is uploaded to the server one level above or at the same level as the <code>flow</code> directory.</p>");
}

// 2. Page Configuration
// Define context for the view (to be used when we convert flow.html to PHP)
$pageConfig = [
    'title' => 'Flow Dashboard',
    'env'   => $config['env'] ?? 'production',
];

// 3. Data Preparation (Placeholder)
// TODO: [Phase 2] Integrate OpenWeatherMap API here to populate $weatherData.
$dashboardData = [
    'status' => 'active',
    'last_updated' => date('Y-m-d H:i:s'),
    'alerts' => []
];

// 4. Render View
// Currently loading the static HTML template.
$viewPath = __DIR__ . '/flow.html';

if (file_exists($viewPath)) {
    include $viewPath;
} else {
    // Graceful error handling if the view is missing
    error_log("View not found: " . $viewPath);
    http_response_code(500);
    echo "<h1>500 Internal Server Error</h1><p>Dashboard view could not be loaded.</p>";
}