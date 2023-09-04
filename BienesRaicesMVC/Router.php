<?php

namespace MVC;

class Router{

    public $rutasGET = [];
    public $rutasPOST = [];

    public function get($url, $fn){
        $this->rutasGET[$url] = $fn;
    }

    public function post($url, $fn){
        $this->rutasPOST[$url] = $fn;
    }

    public function comrprobarRutas()
    {
        session_start();
        $auth = $_SESSION['login'] ?? null;

        //Array de rutas protegidas
        $rutasProtegidas = ['/admin', '/propiedades/crear', '/propiedades/actualizar', '/propiedades/eliminar',
                            '/vendedores/crear', '/vendedores/actualizar', '/vendedores/eliminar'];

        $urlActual = $_SERVER['PATH_INFO'] ?? '/';
        $metodo = $_SERVER['REQUEST_METHOD'];

        if($metodo === 'GET'){
            $fn = $this->rutasGET[$urlActual] ?? null;
        }else{
            $fn = $this->rutasPOST[$urlActual] ?? null;
        }

        //Proteger las rutas
        if(in_array($urlActual, $rutasProtegidas) && !$auth){
            header('Location: /');
        }


        if($fn){
            //La URL existe y tiene una funcion asociada
            call_user_func($fn, $this);
        }else{
            echo "Página no encontrada";
        }
    }

    //Muestra una vista
    public function render($view, $datos = []){

        foreach($datos as $key => $value){
            $$key = $value;
        }
        
        ob_start(); //Inicia el almacenamiento en memoria durante un momento
        include __DIR__ . "/views/$view.php";

        //La variable $contenido la usamos en layout.php
        $contenido = ob_get_clean(); //Limpia el buffer

        include __DIR__ . "/views/layout.php";
    } 

}

?>