<?php
ini_set('display_errors', 1);
error_reporting(E_ALL);

spl_autoload_register(function ($className) {

    $baseDir = __DIR__ . '/../app/';

    $prefix = 'App\\';

    $len = strlen($prefix);
    if (strncmp($prefix, $className, $len) !== 0) {
        return; 
    }

    $relativeClass = substr($className, $len);

    $file = $baseDir . str_replace('\\', '/', $relativeClass) . '.php';

    $parts = explode('/', $file);

    $count = count($parts);
    for ($i = 0; $i < $count - 1; $i++) {
        $parts[$i] = lcfirst($parts[$i]);
    }

    $normalizedFile = implode('/', $parts);

    if (file_exists($normalizedFile)) {
        require $normalizedFile;
    }
});

require_once __DIR__ . '/../app/core/Router.php';

use App\Core\Router;

$router = new Router();

// === РЕГИСТРАЦИЯ МАРШРУТОВ ===
$router->add('^$', ['controller' => 'Home', 'action' => 'index']);
$router->add('^about$', ['controller' => 'Home', 'action' => 'about']);
$router->add('^interests$', ['controller' => 'Home', 'action' => 'interests']);
$router->add('^study$', ['controller' => 'Home', 'action' => 'study']);
$router->add('^photos$', ['controller' => 'Home', 'action' => 'photos']);
$router->add('^history$', ['controller' => 'Home', 'action' => 'history']);
$router->add('^contacts$', ['controller' => 'Home', 'action' => 'contacts']);
$router->add('^test$', ['controller' => 'Test', 'action' => 'index']);

// Запуск
$router->dispatch($_SERVER['QUERY_STRING']);