<?php
namespace App\Core;

class Router {
    private $routes = [];

    public function add($pattern, $params) {
        $this->routes[] = [
            'pattern' => $pattern,
            'params' => $params
        ];
    }

    public function dispatch($query) {
        // Получаем путь без query параметров (?...)
        $path = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);
        // Убираем слэши по краям
        $path = trim($path, '/');

        // die("Текущий путь запроса: [" . $path . "]");
        
        foreach ($this->routes as $route) {
            if (preg_match('#^' . $route['pattern'] . '$#', $path, $matches)) {
                $controllerName = 'App\\Controllers\\' . $route['params']['controller'] . 'Controller';
                $actionName = $route['params']['action'] . 'Action';

                if (class_exists($controllerName)) {
                    $controller = new $controllerName();
                    if (method_exists($controller, $actionName)) {
                        $controller->$actionName();
                        return;
                    }
                }
                throw new \Exception("Контроллер или метод не найден: $controllerName::$actionName");
            }
        }
        
        throw new \Exception("Страница не найдена (404): $path");
    }
}