<?php

namespace Framework;

use App\Controllers\ErrorController;

class Router
{
    private array $routes = [];

    public function registerRoute(string $method, string $uri, string $action): void
    {
        [$controller, $controllerMethod] = explode('@', $action);

        $this->routes[] = [
            'method'           => strtoupper($method),
            'uri'              => $uri,
            'controller'       => $controller,
            'controllerMethod' => $controllerMethod,
        ];
    }

    public function get(string $uri, string $action): void    { $this->registerRoute('GET',    $uri, $action); }
    public function post(string $uri, string $action): void   { $this->registerRoute('POST',   $uri, $action); }
    public function put(string $uri, string $action): void    { $this->registerRoute('PUT',    $uri, $action); }
    public function delete(string $uri, string $action): void { $this->registerRoute('DELETE', $uri, $action); }

    public function route(string $uri): void
    {
        $requestMethod = strtoupper($_SERVER['REQUEST_METHOD']);
        $uri           = '/' . trim(strtok($uri, '?'), '/');
        if ($uri === '') $uri = '/';

        foreach ($this->routes as $route) {
            $uriSegments    = explode('/', trim($uri, '/'));
            $routeSegments  = explode('/', trim($route['uri'], '/'));

            if (count($uriSegments) !== count($routeSegments)) continue;
            if ($route['method'] !== $requestMethod) continue;

            $params = [];
            $match  = true;

            for ($i = 0; $i < count($uriSegments); $i++) {
                if (preg_match('/^\{(.+?)\}$/', $routeSegments[$i], $m)) {
                    $params[$m[1]] = $uriSegments[$i];
                } elseif ($routeSegments[$i] !== $uriSegments[$i]) {
                    $match = false;
                    break;
                }
            }

            if ($match) {
                $controllerClass  = 'App\\Controllers\\' . $route['controller'];
                $controllerMethod = $route['controllerMethod'];

                $instance = new $controllerClass();
                $instance->$controllerMethod($params);
                return;
            }
        }

        ErrorController::notFound();
    }
}
