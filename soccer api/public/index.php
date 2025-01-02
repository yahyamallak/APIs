<?php

require_once dirname(__DIR__) . "/vendor/autoload.php";

use Api\Controllers\PlayerController;
use Masar\Exceptions\NotFoundException;
use Masar\Http\Request;
use Masar\Routing\Router;

$config = [
    "controllers" => "Api\Controllers",
    "middlewares" => "Api\Middlewares"
];

$router = new Router($config);

// Define routes
$router->get('/', function() {
    require_once __DIR__ . '/../pages/home.php';
});

$router->get("/players", [PlayerController::class,"getAllPlayers"]);


// Create a request object
$request = new Request();

// Dispatch the router
try {
    $router->dispatch($request);
} catch (NotFoundException $e) {
    echo $e->getMessage();
}

