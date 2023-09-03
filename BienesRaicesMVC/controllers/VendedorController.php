<?php

namespace Controllers;

use MVC\Router;
use Model\Vendedor;

class VendedorController{

    public static function create(Router $router){

        $errores = Vendedor::getErrores();
        $vendedor = new Vendedor;

        //Ejecutar el codigo despues de que el usuario envia el formulario
        if($_SERVER['REQUEST_METHOD'] === 'POST'){

            //Crear una nueva instancia
            $vendedor = new Vendedor($_POST['vendedor']);

            //Validar que no haya campos vacios
            $errores = $vendedor->validar();

            //No hay errores
            if(empty($errores)){
                $vendedor->guardar();
            }

        }

        $router->render('vendedores/crear',['errores' => $errores,
                                            'vendedor' => $vendedor]);

    }

    public static function update(Router $router){
        $errores = Vendedor::getErrores();
        $id = validarORedireccionar('/admin');

        //Obtener datos del vendedor a actualizar
        $vendedor = Vendedor::findById($id);

        $router->render('vendedores/actualizar', ['errores' => $errores,
                                                  'vendedor' => $vendedor]);

    }

    public static function eliminar(){

    }

}

?>