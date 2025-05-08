<?php
// index.php - Punto de entrada del sistema (enrutador central)

// Activar reporte de errores en desarrollo
ini_set('display_errors', 1);
error_reporting(E_ALL);

// Establecer controlador y acción predeterminados
$controllerName = isset($_GET['controller']) ? $_GET['controller'] : 'home';
$actionName = isset($_GET['action']) ? $_GET['action'] : 'index';

// Construir nombre de clase del controlador
$controllerClass = ucfirst($controllerName) . 'Controller';
$controllerFile = 'app/controllers/' . $controllerClass . '.php';

if (file_exists($controllerFile)) {
    require_once $controllerFile;

    if (class_exists($controllerClass)) {
        $controller = new $controllerClass();

        if (method_exists($controller, $actionName)) {
            call_user_func([$controller, $actionName]);
        } else {
            echo "Error: La acción '$actionName' no existe en el controlador '$controllerClass'.";
        }
    } else {
        echo "Error: El controlador '$controllerClass' no está definido.";
    }
} else {
    echo "Error: No se encontró el archivo del controlador '$controllerFile'.";
}
