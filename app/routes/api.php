<?php
require_once __DIR__ . '/../core/Router.php';
require_once __DIR__ . '/../controllers/DiscosController.php';

$router = new Router();

// Rutas para Discos
$router->add('discos', ['controller' => 'DiscosController', 'action' => 'getAll']);
$router->add('discos/{id}', ['controller' => 'DiscosController', 'action' => 'getById']);
$router->add('discos/create', ['controller' => 'DiscosController', 'action' => 'create'], 'POST'); 
$router->add('discos/update/{id}', ['controller' => 'DiscosController', 'action' => 'update'], 'PUT'); 
$router->add('discos/delete/{id}', ['controller' => 'DiscosController', 'action' => 'delete'], 'DELETE'); 

$url = $_SERVER['REQUEST_URI'];
$method = $_SERVER['REQUEST_METHOD']; 

if ($router->match($url)) {
    $params = $router->getParams();
    $controllerName = $params['controller'];
    $actionName = $params['action'];

    $controller = new $controllerName();

    switch ($method) {
        case 'POST':
            $controller->create();
            break;
        case 'PUT':
            $controller->update($params['id'] ?? null);
            break;
        case 'DELETE':
            $controller->delete($params['id'] ?? null);
            break;
        default: 
            $controller->$actionName($params['id'] ?? null);
            break;
    }
} else {
    http_response_code(404);
    echo json_encode(['error' => 'Not Found']);
}