<?php 

    //Importar la conexion
    require 'includes/config/database.php';
    $db = conectaDB();

    //Crear un email y password
    $email = "correo@correo.com";
    $password = "123456";

    //Query para crear el usuario
    $query = "insert into usuarios (email, password) values ('{$email}', '{$password}');";

    //Agregarlo a la base de datos
    mysqli_query($db, $query);
    

?>