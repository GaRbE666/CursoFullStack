<?php 

define('TEMPLATE_URL', __DIR__ . '/templates');
define('FUNCIONES_URL', __DIR__ . 'funciones.php');

    function incluirTemplate(string $nombre, bool $inicio = false){
        include TEMPLATE_URL . "/{$nombre}.php";
    }

    function estaAutenticado() : bool {
        session_start();

        $auth = $_SESSION['login'];
    
        if($auth){
            return true;
        }

        return false;
    }

?>