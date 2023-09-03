<?php
   
   require_once __DIR__ . '/../includes/app.php'; 

   use MVC\Router;
   use Controllers\PropiedadController;
   use Controllers\VendedorController;

    $router = new Router();

    $router->get('/admin', [PropiedadController::class, 'index']);
    $router->get('/propiedades/crear', [PropiedadController::class, 'create']);
    $router->post('/propiedades/crear', [PropiedadController::class, 'create']);
    $router->get('/propiedades/actualizar', [PropiedadController::class, 'update']);
    $router->post('/propiedades/actualizar', [PropiedadController::class, 'update']);
    $router->post('/propiedades/eliminar', [PropiedadController::class, 'eliminar']);

    $router->get('/vendedores/crear', [VendedorController::class, 'create']);
    $router->post('/vendedores/crear', [VendedorController::class, 'create']);
    $router->get('/vendedores/actualizar', [VendedorController::class, 'update']);
    $router->post('/vendedores/actualizar', [VendedorController::class, 'update']);
    $router->post('/vendedores/eliminar', [VendedorController::class, 'eliminar']);

    $router->comrprobarRutas();

?>