<?php
   
   require_once __DIR__ . '/../includes/app.php'; 

   use MVC\Router;
   use Controllers\PropiedadController;

    $router = new Router();

    $router->get('/admin', [PropiedadController::class, 'index']);
    $router->get('/propiedades/crear', [PropiedadController::class, 'create']);
    $router->post('/propiedades/crear', [PropiedadController::class, 'create']);
    $router->get('/propiedades/actualizar', [PropiedadController::class, 'update']);
    $router->post('/propiedades/actualizar', [PropiedadController::class, 'update']);
    $router->post('/propiedades/eliminar', [PropiedadController::class, 'eliminar']);

    $router->comrprobarRutas();

?>