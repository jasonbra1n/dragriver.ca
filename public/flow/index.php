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
// With src inside public, the relative path is consistent: ../src/bootstrap.php
$bootstrapPaths = [
    __DIR__ . '/../src/bootstrap.php',
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

// 3. Data Preparation
// Load service-specific configuration and fetch data.

// Load Flow-specific config (contains API keys)
$flowConfig = require __DIR__ . '/../src/config.php';

// Load and instantiate the Weather Service
require_once __DIR__ . '/../src/Services/WeatherService.php';
$weatherService = new DragRiver\Services\WeatherService($flowConfig);

// Fetch weather data (from cache or live API)
$weatherData = $weatherService->getWeatherData();


// 4. Render View
// Currently loading the static HTML template.
$viewPath = __DIR__ . '/view.php';

if (file_exists($viewPath)) {
    include $viewPath;
} else {
    // Graceful error handling if the view is missing
    error_log("View not found: " . $viewPath);
    http_response_code(500);
    echo "<h1>500 Internal Server Error</h1><p>Dashboard view could not be loaded.</p>";
}