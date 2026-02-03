<?php

require __DIR__ . '/../../vendor/autoload.php';
require __DIR__ . '/../Bootstrap/app.php';

$uri = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);
$method = $_SERVER['REQUEST_METHOD'];

/**
 * API ROUTES (node-based, dynamic)
 */
if (str_starts_with($uri, '/api')) {
  $apiRoutes = require __DIR__ . '/../Routes/ApiRoutes.php';

  foreach ($apiRoutes as $prefix => $routesClass) {

    $fullPrefix = '/api' . $prefix;

    if ($uri === $fullPrefix || str_starts_with($uri, $fullPrefix . '/')) {

      if (!method_exists($routesClass, 'routes')) {
        break;
      }

      $routes = $routesClass::routes();

      $subUri = substr($uri, strlen($fullPrefix));
      $subUri = $subUri === '' ? '/' : $subUri;

      $key = $method . ' ' . $subUri;

      if (isset($routes[$key])) {
        [$controller, $action] = $routes[$key];
        (new $controller())->$action();
        return;
      }

      http_response_code(404);
      echo 'API Endpoint Not Found';
      return;
    }
  }

  http_response_code(404);
  echo 'API Domain Not Found';
  return;
}

/**
 * WEB ROUTES (node-based)
 */
$routes = require __DIR__ . '/../Routes/WebRoutes.php';

foreach ($routes as $prefix => $handler) {
  if ($uri === $prefix || str_starts_with($uri, $prefix . '/')) {

    // If handler is a node (has sub-routes)
    if (method_exists($handler, 'routes')) {
      $subRoutes = $handler::routes();

      $subUri = substr($uri, strlen($prefix));
      $subUri = $subUri === '' ? '/' : $subUri;

      if (isset($subRoutes[$subUri])) {
        $controller = $subRoutes[$subUri];
        (new $controller())();
        return;
      }
    }

    // Leaf route (single controller)
    (new $handler())();
    return;
  }
}

/**
 * 3. FALLBACK
 */
http_response_code(404);
echo 'Not Found';
