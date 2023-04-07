<?php
class Router {
  private $routes = array();

  public function add_route($method, $path, $handler) {
    $this->routes[] = array(
      'method' => $method,
      'path' => $path,
      'handler' => $handler,
    );
  }

  public function handle_request() {
    $method = $_SERVER['REQUEST_METHOD'];
    $uri = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);

    foreach ($this->routes as $route) {
      if ($route['method'] === $method && preg_match('#^' . $route['path'] . '$#', $uri, $matches)) {
        array_shift($matches);
        list($controller, $action) = explode('@', $route['handler']);
        $controller_instance = new $controller();
        try{
        call_user_func_array(array($controller_instance, $action), $matches);
        }catch(Exception $e){
          error_log("Unable to handle request: $uri");
        }
        return;
      }
    }

    // Send an error response for not found
    // ...

    header("HTTP/1.0 404 Not Found");
    include("404.php");
    exit();

  }
}
?>