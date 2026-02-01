<?php

require __DIR__ . '/../../vendor/autoload.php';

$uri = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);

// Very dumb router (good enough for now)
if ($uri === '/') {
  $routes = require __DIR__ . '/../Routes/WebRoutes.php';
  $handlerClass = $routes['/'];
  (new $handlerClass())();
  return;
}

if ($uri === '/api/sample') {
  $routes = require __DIR__ . '/../Routes/ApiRoutes.php';
  [$class, $method] = $routes['GET /api/sample'];
  (new $class())->$method();
  return;
}

http_response_code(404);
echo 'Not Found';
