<?php

use Illuminate\Http\Request;

define('LARAVEL_START', microtime(true));

// Determine if the application is in maintenance mode...
if (file_exists($maintenance = __DIR__.'/../storage/framework/maintenance.php')) {
    require $maintenance;
}

// Register the Composer autoloader...
require __DIR__.'/../vendor/autoload.php';

$host = $_SERVER['HTTP_HOST'] ?? 'default';

// Define o arquivo .env baseado no domínio
if ($host === 'anistia08dejaneiro.com.br' || $host === 'www.anistia08dejaneiro.com.br') {
    putenv('LARAVEL_ENV=.env.anistia');
} else {
    putenv('LARAVEL_ENV=.env');
}

// Bootstrap Laravel and handle the request...
(require_once __DIR__.'/../bootstrap/app.php')
    ->handleRequest(Request::capture());
