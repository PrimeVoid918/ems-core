<?php

namespace Common\Http;

class HttpService
{

  public function res($status = 200, $success = true, $data = [], $details = [])
  {
    header_remove();
    http_response_code($status);
    /* debug time
      $http->res([ 'msg' => 'something' ]); // ❌ Wrong order
      $http_response_code(['msg' => 'something']); // ← causes fatal error

      the coreect usage
      $http->res(200, true, ['msg' => 'something']); // ✅ works

    */
    header('Content-Type: application/json');
    echo json_encode([
      'success' => $success,
      'status' => $status,
      'details' => $details,
      'timestamp' => time(),
      'data' => $data
    ]);
    exit();

    // usage
    // require_once BASE_PATH . '/src/services/response.php';
    // json_response([ key => value ]);
  }

  public function j_decode($method = null, $associative = true)
  {
    if ($_SERVER['REQUEST_METHOD'] === 'GET') {
      return null;
    }
    // If no method is passed, use php://input
    if ($method === null) {
      $method = file_get_contents('php://input');
    }

    // Decode the JSON data
    $decodedData = json_decode($method, $associative);

    if (json_last_error() !== JSON_ERROR_NONE) {
      $caller = $this->stackTraceErrorDebug(); // ← Now it just returns the caller string!

      echo json_encode([
        'error' => 'Invalid JSON data received',
        'details' => json_last_error_msg(),
        'nexus_event' => $caller
      ]);
      exit();
    }

    return $decodedData;
  }

  public function stackTraceErrorDebug()
  {
    $backtrace = debug_backtrace(DEBUG_BACKTRACE_IGNORE_ARGS, 3);

    if (isset($backtrace[2])) {
      $class = $backtrace[2]['class'] ?? 'UnknownClass';
      $function = $backtrace[2]['function'] ?? 'UnknownFunction';
      $line = $backtrace[2]['line'] ?? 'UnknownLine';
      return "$class::$function at line $line";
    }

    return 'Unknown Caller';
  }
}