<?php
declare(strict_types=1);

// Events Subdomain Entry Point
// events.dragriver.ca

// Bootstrap
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
    die("System Error: Bootstrap not found.");
}

// View
include __DIR__ . '/view.php';