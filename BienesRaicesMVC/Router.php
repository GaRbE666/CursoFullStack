<?php

namespace MVC;

class Router{

    public $rutasGET = [];
    public $rutarPOST = [];

    public function get($url, $fn){
        $this->rutasGET[$url] = $fn;
    }

    public function comrprobarRutas()
    {
        $urlActual = $_SERVER['PATH_INFO'] ?? '/';
        $metodo = $_SERVER['REQUEST_METHOD'];

        if($metodo === 'GET'){
            $fn = $this->rutasGET[$urlActual] ?? null;
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