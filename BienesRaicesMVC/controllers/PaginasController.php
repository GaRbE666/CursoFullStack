<?php

namespace Controllers;

use MVC\Router;
use Model\Propiedad;

class PaginasController{

    public static function index(Router $router){

        $propiedades = Propiedad::get(3);
        $inicio = true;

        $router->render('paginas/index', ['propiedades' => $propiedades,
                                          'inicio'      => $inicio]);

    }

    public static function nosotros(){
        
    }

    public static function propiedades(){
        
    }

    public static function propiedad(){
        
    }

    public static function blog(){
        
    }

    public static function entrada(){
        
    }

    public static function contacto(){
        
    }

}

?>