<?php
// src/bootstrap.php
// Application initialization and configuration

// Define project root constant for easy file path resolution
define('PROJECT_ROOT', dirname(__DIR__));

// Basic configuration
$config = [
    'app_name' => 'Drag River Creative',
    'env' => 'development', // Toggle to 'production' on live server
    'version' => '0.1.0'
];

// Error reporting
if ($config['env'] === 'development') {
    error_reporting(E_ALL);
    ini_set('display_errors', 1);
}