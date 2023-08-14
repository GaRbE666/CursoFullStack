<?php

    function obtener_servicios(){
        try{

            //importar las credenciales
            require('database.php');

            //consulta sql
            $sql = "SELECT * FROM servicios;";

            //realizar la consulta
            $query = mysqli_query($db, $sql);

            //cerrar la conexion
            $result = mysqli_close($db);
            echo $result;

            return $query;

        }catch (\Throwable $th){
            var_dump($th);
        }
    }

    obtener_servicios();

?>