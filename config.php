<?php
/**
 * MongoDB Configuration
 * Reads from environment variables (set in Railway dashboard or .env file locally)
 */

// Load .env file for local development if it exists
if (file_exists(__DIR__ . '/.env')) {
    $lines = file(__DIR__ . '/.env', FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES);
    foreach ($lines as $line) {
        if (strpos(trim($line), '#') === 0) continue;
        if (strpos($line, '=') !== false) {
            [$key, $value] = explode('=', $line, 2);
            $_ENV[trim($key)] = trim($value);
            putenv(trim($key) . '=' . trim($value));
        }
    }
}

$mongoUri = getenv('MONGO_URI') ?: 'mongodb://localhost:27017';
$dbName   = getenv('MONGO_DB')  ?: 'eventcleanup';

require_once __DIR__ . '/vendor/autoload.php';

try {
    $client = new MongoDB\Client($mongoUri);
    $db     = $client->selectDatabase($dbName);
} catch (Exception $e) {
    die("MongoDB connection failed: " . $e->getMessage());
}
