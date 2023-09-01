<?php

namespace Controllers;
use MVC\Router;

class PropiedadController{
    
    public static function index(Router $router){
        $router->render('propiedades/admin', ['mensaje' => 'desde la vista']);
    }

    public static function create(){
        echo "Crear propiedad";
    }

    public static function update(){
        echo "Actualizar propiedad";
    }

}

?>